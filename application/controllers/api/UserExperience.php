<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class UserExperience extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserExperience_model', 'userExperience');
    }

    public function index_get() 
    {
        $id = $this->get('id');
        if ($id === null){
            $userExperience = $this->userExperience->getUserExperience();
        } else {
            $userExperience = $this->userExperience->getUserExperience($id);
        }
        
        if ($userExperience) {
            $this->response([
                'status' => true,
                'data' => $userExperience
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
            if ( $this->userExperience->deleteUserExperience($id) > 0 ) {
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
            'swap' => $this->post('swap'),
            'crop' => $this->post('crop'),
            'mix' => $this->post('mix'),
            'help' => $this->post('help'),
            'about' => $this->post('about')
        ];

        if ($this->userExperience->createUserExperience($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new experience has been created.'
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
            'swap' => $this->put('swap'),
            'crop' => $this->put('crop'),
            'mix' => $this->put('mix'),
            'help' => $this->put('help'),
            'about' => $this->put('about')
        ];

        if ($this->userExperience->updateUserExperience($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data experience has been updated.'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}