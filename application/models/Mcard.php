<?php

/**
 * Created by PhpStorm.
 * User: amttm
 * Date: 3/11/2016
 * Time: 3:07 AM
 */
class Mcard extends CI_Model
{
    public function addCard()
    {
        $customer_id = $this->input->post('customer_id');
        $updaterec = array("status" => '0');
        $this->db->where('customer_id', $customer_id);
        $this->db->update('tbl_cards', $updaterec);

        $newCard = array(
            'customer_id' => $this->input->post('customer_id'),
            'card_no' => $this->input->post('card_no'),
            'added_date' => $this->input->post('added_date'),
            'entrydate' => date('Y-m-d'),
            'enteredby' => 'amt',
            'status' => '1'
        );
        $res = $this->db->insert('tbl_cards', $newCard);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function getCard($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->where('status', 1);
        $card = $this->db->get('tbl_cards');
        return $card->row();
    }

    public function getAllCards($customer_id)
    {
        $this->db->where('md5(customer_id)', $customer_id);
        $this->db->order_by('added_date','desc');
        $card = $this->db->get('tbl_cards');
        return $card->result();
    }

    public function hasCard($customer_id)
    {
        $this->db->where('md5(customer_id)', ($customer_id));
        $this->db->where('status', 1);
        $card = $this->db->get('tbl_cards');
        if ($card->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}