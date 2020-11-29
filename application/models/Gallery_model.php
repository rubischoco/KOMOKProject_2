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

    public function deleteGallery($id)
    {
        $this->db->delete('gallery', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createGallery($data)
    {
        $this->db->insert('gallery', $data);
        return $this->db->affected_rows();
    }

    public function updateGallery($data, $id)
    {
        $this->db->update('gallery', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}