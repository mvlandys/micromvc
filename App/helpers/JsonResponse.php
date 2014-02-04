<?php
    namespace Matheos\App;

    class JsonResponse {
        private $error, $errorMsg, $data;

        public function set_Data($data) {
            $this->data = $data;
        }

        public function set_Error($error) {
            $this->error = 1;
            $this->errorMsg = $error;
        }

        public function send() {
            if ($this->error == 1) {
                echo json_encode( array(
                    "error"     => $this->error,
                    "error_msg" => $this->errorMsg
                ));
            } else {
                echo json_encode( array($this->data) );
            }
        }
    }
