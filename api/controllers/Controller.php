<?php
namespace Api\Controllers;

use Api\Models\Model;
use Api\Services\ResponseService;
use Api\Services\ControllerService;

class Controller
{
    protected $model;
    protected $response_service;
    protected $controller_service;
    protected $status_code;

    public function __construct()
    {
        $this->model = new Model();
        $this->response_service = new ResponseService();
        $this->controller_service = new ControllerService();
        $this->status_code = include 'api/config/status_code.php';
    }

    public function create(Array $params)
    {
        $is_short_url = true;
        $short_url = $this->controller_service->generate();       
        $this->model->set($short_url, $params['url']);
        $this->response_service->header();
        $this->response_service->sendResponse($short_url, $is_short_url);
    }

    public function redirect($short_uri)
    {
       $full_url = $this->model->get($short_uri);

        if (is_array($full_url) && isset($full_url)) {
            $this->response_service->header($this->status_code['200']);
            $this->response_service->redirect($full_url['origin']);
        } else {
            $this->response_service->header($this->status_code['204']);
        }
    }
}