<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->library('form_validation');
        $this->load->model('m_order', 'order');

    }

    public function index()
    {
        $data['title'] = "Orders";
        $data['content'] = $this->load->view('pages/orders/order_view', '', true);
        $this->parser->parse('template/page_template', $data);
    }

    public function order_products()
    {
        $master['status'] = True;
        $data = array();
        $master = array();
        $this->form_validation->set_rules('customer', 'Customer', 'callback_dropdown_fun');
        $this->form_validation->set_rules('order_date', 'Order date', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('deadline_date', 'Deadline date', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|max_length[600]');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == True) {
            $order_id = $this->order->insert();

            if ($this->input->post('remarks')) {
                $data = array(
                    'order_id' => $order_id,
                    'order_no' => $this->generate_order_no()
                );
                $this->db->insert('tbl_order_details', $data);
            }

            if (!empty($_POST['model_no'])) {
                $model_no = $_POST['model_no'];

                foreach ($model_no as $key => $value) {
                    $data = array(
                        'reference_product_id' => $value,
                        'order_id' => $order_id,
                        'order_no' => $this->generate_order_no()
                    );
                    $this->db->insert('tbl_order_details', $data);
                }
                $this->destroy_ordered_products();
            }
            $this->session->set_flashdata('message', 'Order saved successsfully !');
            $master['status'] = True;
        } else {
            $master['status'] = false;
            foreach ($_POST as $key => $value) {
                if (form_error($key) != '') {
                    $data['error_string'] = $key;
                    $data['input_error'] = form_error($key);
                    array_push($master, $data);
                }
            }
        }
        echo(json_encode($master));
    }

    public function add_to_order($product_id = '')
    {
        $ordered_product = array();
        $price = '';
        $model_no = '';
        $qty = '';

        $this->db->where('product_id', $product_id);
        $products = $this->db->get('tbl_products')->result();

        foreach ($products as $product) {
            $price = $product->price;
            $model_no = $product->model_no;
        }
        $data = array(
            'id' => $product_id,
            'qty' => 1,
            'price' => $price,
            'name' => $model_no,
        );
        if ($this->cart->insert($data)) {
            $ordered_product['status'] = true;
        } else {
            $ordered_product['status'] = false;
        }
        echo(json_encode($ordered_product));

    }

    public function display_ordered_products()
    {
        $master['products'] = array();
        $data = $this->cart->contents();
        foreach ($data as $product) {
            $temp = array();
            $temp['row_id'] = $product['rowid'];
            $temp['model_no'] = $product['name'];
            $temp['price'] = $product['price'];
            $temp['product_id'] = $product['id'];
            $temp['qty'] = $product['qty'];
            $temp['image_url'] = $this->get_product_image_url($product['id']);
            array_push($master['products'], $temp);
        }
        $master['status'] = true;
        echo(json_encode($master));
    }

    public function destroy_ordered_products()
    {
        $this->cart->destroy();
        //echo("destroyed");
    }

    public function get_product_image_url($id)
    {
        $this->db->select('image_url');
        $this->db->where('product_id', $id);
        $data = $this->db->get('tbl_products')->result();
        return (base_url('uploads/' . $data[0]->image_url));
    }

    public function remove_ordered_product($id = '')
    {
        $data['status'] = false;
        $data = array(
            'rowid' => $id,
            'qty' => 0
        );
        if ($this->cart->update($data)) {
            $data['status'] = true;
        }
        echo(json_encode($data));

    }

    public function generate_order_no()
    {
        $this->db->select_max('order_detail_id');
        $query = $this->db->get('tbl_order_details')->result();
        return ('rb_' . $query[0]->order_detail_id);
    }

    public function fill_combobox()
    {
        $this->db->select(array('customer_id', 'fname', 'mname', 'lname'));
        $combo = $this->db->get('tbl_customers')->result();
        $temp_data = '';
        $temp_data .= '<option value="0">--Select Customer Name--</option>';
        foreach ($combo as $value) {
            $temp_data .= '<option value="' . $value->customer_id . '">' . $value->fname . ' ' . $value->mname . ' ' . $value->lname . '</option>';
        }
        echo($temp_data);
    }

    public function dropdown_fun($value)
    {
        if ($value == '0') {
            $this->form_validation->set_message('dropdown_fun', 'Please select product category');
            return false;
        }
        return true;
    }

    public function get_remarks($order_id)
    {
        $this->db->select('remarks');
        $this->db->where('order_id', $order_id);
        echo(json_encode($this->db->get('tbl_orders')->result()));
    }

    public function update_remarks($order_id)
    {
        $this->db->where('order_id', $order_id);
        if ($this->db->update('tbl_orders', array('remarks' => $this->input->post('remarks'), 'updated_at' => getCurrentDate()))) {
            echo(json_encode($data['status'] = true));
            return;
        } else {
            echo(json_encode($data['status'] = false));
            return;
        }

    }

    public function complate_order($order_id)
    {
        $data = array(
            'updated_at' => getCurrentDate(),
            'complate' => true
        );
        $this->db->where('order_id', $order_id);
        $this->db->update('tbl_orders', $data);
        $this->session->set_flashdata('message', 'Order complated successfully !!!');
        redirect('order_progress_detail/view_progress/' . $order_id, 'refresh');
    }

    public function getActiveOrdersByCustomer($customer_id = '')
    {
        if ($customer_id == '') {
            show_404();
        }
        $data = $this->order->getActiveOrdersByCustomer($customer_id);
        if (count($data) > 0) {
            ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        Order No
                    </th>
                    <th>
                        Model No
                    </th>

                    <th>
                        Category
                    </th>
                    <th>
                        Product Name
                    </th>
                    <th>
                        Gross Weight
                    </th>
                    <th>
                        Net. Weight
                    </th>
                    <th>
                        Weight Loss
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Image
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                </thead>
                <tbody id="tblcontent">

                <?php

                foreach ($data as $dt) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $dt->order_no ?>
                        </td>
                        <td>
                            <?php echo $dt->model_no ?>
                        </td>
                        <td>
                            <?php echo $dt->category_id ?>
                        </td>
                        <td>
                            <?php echo ($dt->product_name = '') ? $dt->product_name : $dt->remarks ?>
                        </td>
                        <td>
                            <?php echo $dt->gross_weight ?>
                        </td>
                        <td>
                            <?php echo $dt->net_weight ?>
                        </td>
                        <td>
                            <?php echo $dt->weight_loss ?>
                        </td>
                        <td>
                            <?php echo $dt->price ?>
                        </td>
                        <td>
                            <?php echo $dt->image_url ?>
                        </td>
                        <td>
                            <?php echo ($dt->price) > 0 ? 'Ready' : 'Not Complete' ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm btnaddorder"
                                    data-productid="<?php echo $dt->product_id ?>">Add
                            </button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <script>
                $('.btnaddorder').click(function () {
                    var product_id = $(this).data('productid');
                    $.ajax({
                        url: '<?php echo base_url('sales/setcard') ?>/' + product_id,
                        success: function (res) {
                            alert(res);
                        }
                    });
                })
            </script>
            <?php
        }
    }


}

/* End of file order.php */
/* Location: ./application/controllers/order.php */