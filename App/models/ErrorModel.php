<?php
namespace Matheos\App;

use Matheos\MicroMVC\Model;

class ErrorModel extends Model
{
    public function insert_Error($message, $code, $trace=null)
    {
        $error_id = $this->db->errors->insert(array(
            "error"         => $message,
            "code"          => $code,
            "requestmethod" => $_SERVER["REQUEST_METHOD"],
            "requesturl"    => $_SERVER["REQUEST_URI"],
            "useragent"     => $_SERVER["HTTP_USER_AGENT"],
            "userip"        => $_SERVER["REMOTE_ADDR"],
            "trace"         => (empty($Trace)) ? json_encode(debug_backtrace()) : json_encode($trace),
        ));

        return $error_id;
    }

    public function get_Error($id)
    {
        return $this->db->errors->select("*")->where("id = ?", $id)->fetch();
    }
}
