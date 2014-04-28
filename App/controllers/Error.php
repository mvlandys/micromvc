<?php
namespace Matheos\App;

use Matheos\MicroMVC\AppConfig;
use Matheos\MicroMVC\Controller;

class Error extends Controller
{
    /*
     *  Custom Error Method
     *
     *  Outputs the error and saves error to the db
     *
     *  @param int $errno
     *  @param string $errstr
     *  @param string $errfile
     *  @param int $errline
     */
    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $appCfg    = AppConfig::getInstance();
        $logErrors = $appCfg->config->Core->logErrors;

        if ($logErrors == "true") {
            $errorID = $this->model->insert_Error($errstr, $errno);
            echo "<b>Error ID:</b> " . $errorID;
        } else {
            echo "<br/><b>Error :</b> <i>$errstr</i><br/><b>Line $errline:</b> $errfile<br/>";
        }

        exit(1);
    }

    /*
     *  Custom Exception Method
     *
     *  Outputs the exception and saves details to the db
     *
     *  @param \Exception $e
     */
    public function exceptionHandler($e)
    {
        $appCfg    = AppConfig::getInstance();
        $logErrors = $appCfg->config->Core->logErrors;

        if ($logErrors == "true") {
            $errorID = $this->model->insert_Error($e->getMessage(), $e->getCode(), $e->getTrace());
            echo "<b>Error ID:</b> " . $errorID;
        } else {
            echo "<br/><b>Exception :</b> <i>" . $e->getMessage() . "</i><br/>";
        }

        exit(1);
    }

    /*
     *  Shutdown Error Method
     *
     *  Outputs the error and saves error to the db
     *
     */
    public function shutdownHandler()
    {
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

            $appCfg    = AppConfig::getInstance();
            $logErrors = $appCfg->config->Core->logErrors;

            if ($logErrors == "true") {
                $errorID = $this->model->insert_Error($errstr, $errno, $trace);
                echo "<b>Error ID:</b> " . $errorID;
            } else {
                echo "<br/><b>Fatal error :</b> <i>$errstr</i><br/><b>Line $errline:</b> $errfile<br/>";
            }
        }
    }

    /*
     *  Show Error View Method
     *
     *  Renders the view-error page
     *
     *  @param int $errorId
     */
    public function showError($errorId)
    {
        $ErrorModel = new ErrorModel();
        $Error      = $ErrorModel->get_Error($errorId);

        $this->renderSite("error.php", $Error);
    }
}
