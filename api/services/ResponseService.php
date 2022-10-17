<?php
namespace Api\Services;

class ResponseService
{
    private function getMessage($status_code)
    {
        switch ($status_code) {
            case '200' :
                return 'OK';
                break;
            case '204' :
                return 'No content';
                break;
            case '400':
                return 'Bad request';
                break;
            case '404':
                return 'Page not found';
                break;    
        }
    }

    public function header($status_code = '200')
    {
        $response_message = $this->getMessage($status_code);
        header('HTTP/1.1 ' . $status_code . ' ' . $response_message);
        header('Content-type: application/json');
    }
    
    public function page404()
    {
        $this->header('404');
    }

    public function sendResponse($data, $is_short_url = false)
    {
        if ($is_short_url) {
            $response = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $data;
        } 
        echo json_encode($response);
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }
}