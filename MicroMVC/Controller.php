<?php
/**
 * Controller Class
 *
 * The Core Controller Class
 *
 * @package    MicroMVC
 * @author     Mathew Vlandys <mvlandys@gmail.com>
 * @license    https://www.apache.org/licenses/LICENSE-2.0.html  Apache License v2.0
 *
 */

namespace Matheos\MicroMVC;

class Controller
{
    protected $view;
    protected $model;

    public function __construct()
    {
        $this->view  = new \Matheos\MicroMVC\View($this->className());

        $modelFile  = $this->className() . "Model";
        $modelClass = "\\Matheos\\App\\" . $modelFile;

        if (file_exists(dirname(__FILE__) . "/../App/models/{$modelFile}.php")) {
            $this->model = new $modelClass;
        }
    }

    public function renderSite($views = null)
    {
        $MainController = new \Matheos\App\Main();
        $MainController->renderHtml($this->className());
        $MainController->renderHeader();

        foreach ($views as $view) {
            $view->renderView();
        }

        $MainController->renderFooter();
    }

    public function className()
    {
        $class = explode('\\', get_class($this));
        return end($class);
    }

    public function debugArray($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    public function redirect($url)
    {
        $AppConfig = \Matheos\MicroMVC\AppConfig::getInstance()->config;
        $Hostname  = $AppConfig->Core->hostname;

        header("Location: http://" . $Hostname . $url);
        exit(1);
    }
}
