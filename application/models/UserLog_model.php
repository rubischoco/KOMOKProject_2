<?php

class UserLog_model extends CI_Model
{
    public function getUserLog($id = null)
    {
        if ( $id === null ) {
            return $this->db->get('user_log')->result_array();
        } else {
            return $this->db->get_where('user_log', ['id' => $id])->result_array();
        }
    }

    public function deleteUserLog($id)
    {
        $this->db->delete('user_log', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createUserLog($data)
    {
        $this->db->insert('user_log', $data);
        return $this->db->affected_rows();
    }

    public function updateUserLog($data, $id)
    {
        $this->db->update('user_log', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}