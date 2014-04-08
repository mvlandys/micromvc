<?php
namespace Matheos\MicroMVC;

class View
{
    public $parent;
    public $viewFile;

    public function __construct($parentClass)
    {
        $this->parent   = $parentClass;
        $this->viewFile = "_view.php";
        $this->viewData = array();
    }

    public function renderView($view = null, $viewData = null)
    {
        $view     = (empty($view)) ? $this->viewFile : $view;
        $viewData = (empty($viewData)) ? $this->viewData : $viewData;

        ob_start();
        /* Load the view */
        $viewFilename = dirname(__FILE__) . "/../App/views/" . $this->parent . "/" . $view;
        if (file_exists($viewFilename)) {
            include($viewFilename);
        } else {
            throw new \Exception("Cannot locate view: ".$viewFilename);
        }
        // Return the contents of the output buffer
        $html = ob_get_contents();
        ob_end_clean();

        echo $html;
    }
}
