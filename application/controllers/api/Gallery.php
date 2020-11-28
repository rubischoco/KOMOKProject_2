<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Gallery extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gallery_model', 'gallery');
    }

    public function index_get() 
    {
        $id = $this->get('id');
        if ($id === null){
            $gallery = $this->gallery->getGallery();
        } else {
            $gallery = $this->gallery->getGallery($id);
        }
        
        if ($gallery) {
            $this->response([
                'status' => true,
                'data' => $gallery
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}