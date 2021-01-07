<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class UserLog extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserLog_model', 'userLog');
    }

    public function index_get() 
    {
        $id = $this->get('id');
        if ($id === null){
            $userLog = $this->userLog->getUserLog();
        } else {
            $userLog = $this->userLog->getUserLog($id);
        }
        
        if ($userLog) {
            $this->response([
                'status' => true,
                'data' => $userLog
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ( $this->userLog->deleteUserLog($id) > 0 ) {
                // ok
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted.'
                ], REST_Controller::HTTP_OK);
            } else {
                // id not found
                $this->response([
                    'status' => false,
                    'message' => 'id not found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'email' => $this->post('email'),
            'action' => $this->post('action'),
            'time' => $this->post('time')
        ];

        if ($this->userLog->createUserLog($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new log has been created.'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to create new data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'email' => $this->put('email'),
            'action' => $this->put('action'),
            'time' => $this->put('time')
        ];

        if ($this->userLog->updateUserLog($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data log has been updated.'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}