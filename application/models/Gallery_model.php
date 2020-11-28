<?php

class Gallery_model extends CI_Model
{
    public function getGallery($id = null)
    {
        if ( $id === null ) {
            return $this->db->get('gallery')->result_array();
        } else {
            return $this->db->get_where('gallery', ['id' => $id])->result_array();
        }
    }
}