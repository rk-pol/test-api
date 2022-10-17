<?php
namespace Api\Services;

use Api\Models\Model;

class ControllerService
{
    protected $model;

    public function __construct()
    {
        $this->model = new Model();
    }
    /**
     * Undocumented function
     *
     * @return String
     */
    public function generate()
    {
        for (;;) {
            $random_string = chr(rand(97,122)) . substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 16);
            if ($this->model->get($random_string) === false) {
                return $random_string;
                break;
            }
        }
    }
}