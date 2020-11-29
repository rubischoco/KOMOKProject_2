<?php

class UserExperience_model extends CI_Model
{
    public function getUserExperience($id = null)
    {
        if ( $id === null ) {
            return $this->db->get('user_experience')->result_array();
        } else {
            return $this->db->get_where('user_experience', ['id' => $id])->result_array();
        }
    }

    public function deleteUserExperience($id)
    {
        $this->db->delete('user_experience', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createUserExperience($data)
    {
        $this->db->insert('user_experience', $data);
        return $this->db->affected_rows();
    }

    public function updateUserExperience($data, $id)
    {
        $this->db->update('user_experience', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}