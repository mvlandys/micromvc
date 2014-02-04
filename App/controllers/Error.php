<?php
	namespace Matheos\App;

	class Error extends \Matheos\MicroMVC\Controller {
        public function errorHandler($errno, $errstr, $errfile, $errline) {
            echo "<br/><b>Error :</b> <i>$errstr</i><br/><b>Line $errline:</b> $errfile<br/>";

            $AppConfig = \Matheos\MicroMVC\AppConfig::getInstance();
            $LogErrors = $AppConfig->config->Core->logErrors;

            if ($LogErrors == "true") {
                $errorID = $this->model->insert_Error($errstr, $errno);
                echo "<b>Error ID:</b> " . $errorID;
            }

            exit(1);
        }

        public function exceptionHandler($e) {
            echo "<br/><b>Exception :</b> <i>" . $e->getMessage() . "</i><br/>";

            $AppConfig = \Matheos\MicroMVC\AppConfig::getInstance();
            $LogErrors = $AppConfig->config->Core->logErrors;

            if ($LogErrors == "true") {
                $errorID = $this->model->insert_Error($e->getMessage(), $e->getCode(), $e->getTrace());
                echo "<b>Error ID:</b> " . $errorID;
            }

            exit(1);
        }

        public function shutdownHandler() {
            $error = error_get_last();
            if (!empty($error)) {
                $errno   = $error["type"];
                $errstr  = $error["message"];
                $errfile = $error["file"];
                $errline = $error["line"];

                $trace   = array(array(
                    "line"  => $errline,
                    "file"  => $errfile
                ));

                echo "<br/><b>Fatal error :</b> <i>$errstr</i><br/><b>Line $errline:</b> $errfile<br/>";

                $AppConfig = \Matheos\MicroMVC\AppConfig::getInstance();
                $LogErrors = $AppConfig->config->Core->logErrors;

                if ($LogErrors == "true") {
                    $errorID = $this->model->insert_Error($errstr, $errno, $trace);
                    echo "<b>Error ID:</b> " . $errorID;
                }
            }
        }

        public function showError( $ErrorID ) {
            $ErrorModel = new ErrorModel();
            $Error      = $ErrorModel->get_Error( $ErrorID );

            $this->renderSite("error.php", $Error);
        }
	}
