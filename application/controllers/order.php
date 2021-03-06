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
        $this->load->model('m_payment','payment');

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
            $this->payment->insert($order_id,"advance");
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
                        'order_no' => $this->generate_order_no(),
                        'remarks'  => $this->input->post('product_remarks')
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

    public function update($order_id)
    {

        $content=array();
        $this->cart->destroy();
        $this->db->select('tbl_order_details.*,tbl_products.model_no,tbl_products.product_id,tbl_products.price,tbl_products.model_no');
        $this->db->from('tbl_order_details');
        $this->db->join('tbl_products','tbl_products.product_id=tbl_order_details.reference_product_id');
        $this->db->where('tbl_order_details.reference_product_id is not null',null,false);
        $this->db->where('tbl_order_details.order_id',$order_id);
        $order_item=$this->db->get();

        $payment=$this->db->from('tbl_payments')->where('order_id',$order_id)->where('type','advance')->get();
        if ($payment->num_rows() > 0) 
        {
            $tp=$payment->first_row();
           $content['payment']=$tp->amount;
        }
        if ($order_item->num_rows()> 0) 
        {
              foreach ($order_item->result() as $product) 
              {
                $data = array(
                    'id' => $product->product_id,
                    'qty' => 1,
                    'price' => $product->price,
                    'name' => $product->model_no,
                    'options' => array('Remarks' =>$product->remarks,'order_detail_id'=>$product->order_detail_id)
                );
                $this->cart->insert($data);

              }
        }
       
       if (isset($_POST['submit'])) 
       {
             $this->update_order($order_id);
            
          
       }
        
        $order=$this->db->from('tbl_orders')->where('order_id',$order_id)->get();
        $content['order']=$order->first_row();
        $data['title'] = "Update Order";
        $data['content'] = $this->load->view('pages/orders/edit_order_view',$content, true);
        $this->parser->parse('template/page_template', $data);
    }

    public function update_order($order_id)
    {
        
        /*$this->form_validation->set_rules('customer', 'Customer', 'callback_dropdown_fun');*/
        $this->form_validation->set_rules('order_date', 'Order date', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('deadline_date', 'Deadline date', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|max_length[600]');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        
        if ($this->form_validation->run() == True) 
        {

            $this->order->update($order_id);
            /*$this->payment->update($order_id,"advance");*/
            if (!empty($_POST['model_no'])) 
            {
                $model_no = $_POST['model_no'];
                $order_detail_id=$this->input->post('order_detail_id');
                $product_remarks=$this->input->post('product_remarks');
                foreach ($model_no as $key => $value) 
                {
                    if ($order_detail_id[$key]=='undefined') 
                    {
                        $data = array(
                            'reference_product_id' => $value,
                            'order_id' => $order_id,
                            'order_no' => $this->generate_order_no(),
                            'remarks'  => $product_remarks[$key]
                        );
                        $this->db->insert('tbl_order_details', $data);
                    }

                    $data = array(
                        'remarks'  => $product_remarks[$key]
                    );
                    $this->db->where('order_detail_id',$order_detail_id[$key]);
                    $this->db->update('tbl_order_details', $data);
                }
                $this->destroy_ordered_products();
            }
            $this->session->set_flashdata('message', 'Order updated successsfully !');
            redirect('order/update/'.$order_id,'refresh');
           
        } 
        

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
            $temp['remarks']='';
            if ($this->cart->has_options($product['rowid']) == TRUE) 
            {
               $remarks=$this->cart->product_options($product['rowid']);
               $temp['remarks']=$remarks['Remarks'];
               $temp['order_detail_id']=$remarks['order_detail_id'];

            }

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
        return ('rb_' . (100+$query[0]->order_detail_id));
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
                        <td >
                            <?php echo $dt->model_no ?>
                        </td>
                        <td >
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
                        <td >
                            <?php echo $dt->price ?>
                        </td>
                        <td>
                           <img src="<?php echo $dt->image_url ?>" width="35px"> 
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
            
            <?php
        }
    }
    public function getActiveOrdersByModelNo($model_no = '')
    {
        if ($model_no == '') {
            show_404();
        }
        $data = $this->order->getActiveOrdersByModelNo($model_no);
        if (count($data) > 0) {
            ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    
                    <th>
                        Model No
                    </th>

                    <th>
                        Category
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
                        Action
                    </th>
                </tr>
                </thead>
                <tbody id="tblcontent">

                <?php

                foreach ($data as $dt) {
                    ?>
                    <tr>
                       
                        <td >
                            <?php echo $dt->model_no ?>
                        </td>
                        <td >
                            <?php echo $dt->category ?>
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
                        <td >
                            <?php echo $dt->price ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url('uploads/'.$dt->image_url); ?>" class="image-link">
                                <img src="<?php echo base_url('uploads/'.$dt->image_url); ?>" width="35px"></a>
                        </td>
                        
                        <td>
                            <button type="button" class="btn btn-primary btn-sm  btnaddneworder"
                                    data-productid="<?php echo $dt->product_id ?>">Add
                            </button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            
            <?php
        }
    }

    public function enquiry_order($enquiry_id)
    {
        $master['status'] = True;
        $data = array();
        $master = array();
        $this->form_validation->set_rules('orderdate', 'Order Date', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('deadlinedate', 'Deadline Date', 'trim|required|max_length[20]');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == True) {

            $data=$this->db->from('tbl_enquiry')->where('enquiry_id',$enquiry_id)->get();
            if ($data->num_rows() > 0) 
            {
                $enquiry=$data->result();

                $customer_id=$enquiry[0]->customer_id;

                $order_data=array(
                    'customer_id'=>$enquiry[0]->customer_id,
                    'order_date'=>$this->input->post('orderdate'),
                    'deadline_date'=>$this->input->post('deadlinedate'),
                    'status'=>1,
                    'is_reference'=>true
                    );
                $this->db->insert('tbl_orders',$order_data);
                $order_id= $this->db->insert_id();

                $order_detail_data=array(
                    'order_id'=>$order_id,
                    'reference_product_id'=>$this->find_product_id_by_model_no($enquiry[0]->enquiry_items),
                    'remarks'=>$this->input->post('remarks'),
                    'order_no'=>$this->generate_order_no(),
                    'order_id'=>$order_id,
                    'status'=>1
                    );

                $this->db->insert('tbl_order_details',$order_detail_data);
                $this->db->update('tbl_enquiry',array('en_order_status'=>true));
                $master['status'] = True;

            }
            else
            {
                $master['status'] = false;
            }
            
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

    public function find_product_id_by_model_no($model_no)
    {
        $this->db->where('model_no',$model_no);
        $data=$this->db->get('tbl_products');

        if ($data->num_rows() > 0) 
        {
            $product=$data->result();
            return $product[0]->product_id ;
            
        }
        else
        {
          
            return '';
        }
    }


    public function delete_ordered_product($order_detail_id)
    {
        $this->db->where('order_progress_id',$order_detail_id);
        $this->db->delete('tbl_order_progress');

        $this->db->where('order_detail_id',$order_detail_id);
        $this->db->delete('tbl_order_details');
    }

    public function test()
    {
        $timestamp = strtotime("+1 days");

        echo(date('Y-m-d 00:00:00', $timestamp));
        echo("<br/>");
        echo(date('Y-m-d 23:59:59', $timestamp));
        echo("<br/>");
        echo(date('Y-m-d',strtotime('2012/2/3')));
       
    }

    public function update_order_remind($order_id)
    {
        $date=strtotime($this->input->post('days'));
        $date=date('Y-m-d',$date);
        $this->db->where('order_id',$order_id);
        $this->db->update('tbl_orders',array('remind_date'=>$date));
    }


}

/* End of file order.php */
/* Location: ./application/controllers/order.php */