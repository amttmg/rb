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
        $newCard = array(
            'customer_id' => $this->input->post('customer_id'),
            'card_no' => $this->input->post('card_no'),
            'added_date' => $this->input->post('added_date'),
            'entrydate' => date('y-d-m'),
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
        $card = $this->db->get('tbl_cards');
        return $card->row();
    }
}