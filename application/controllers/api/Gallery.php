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

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ( $this->gallery->deleteGallery($id) > 0 ) {
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
            'nama' => $this->post('nama'),
            'gambar' => $this->post('gambar'),
            'tipe' => $this->post('tipe')
        ];

        if ($this->gallery->createGallery($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new gallery has been created.'
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
            'nama' => $this->put('nama'),
            'gambar' => $this->put('gambar'),
            'tipe' => $this->post('tipe')
        ];

        if ($this->gallery->updateGallery($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data gallery has been updated.'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}