<?php
namespace Matheos\App;

class JsonResponse
{
    private $error;
    private $errorMsg;
    private $data;

    public function __construct()
    {
        $this->error    = "0";
        $this->errorMsg = "";
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setError($error)
    {
        $this->error    = 1;
        $this->errorMsg = $error;
    }

    public function send()
    {
        echo json_encode(array(
            "error"     =>  $this->error,
            "error_msg" =>  $this->errorMsg,
            "data"      =>  $this->data
        ));
    }
}
