<?php
	namespace Matheos\App;

	class ErrorModel extends \Matheos\MicroMVC\Model {
        public function insert_Error($Error, $Code, $Trace=null) {
            $dbData = array(
                "error"         => $Error,
                "code"          => $Code,
                "requestmethod" => $_SERVER["REQUEST_METHOD"],
                "requesturl"    => $_SERVER["REQUEST_URI"],
                "useragent"     => $_SERVER["HTTP_USER_AGENT"],
                "userip"        => $_SERVER["REMOTE_ADDR"],
                "trace"         => (empty($Trace)) ? json_encode(debug_backtrace()) : json_encode($Trace),
            );

            return $this->db->errors->insert($dbData);
        }

        public function get_Error($id) {
            return $this->db->errors->select("*")->where("id = ?", $id)->fetch();
        }
	}
