<?php
namespace Matheos\App;

use Matheos\MicroMVC\Controller;

class Main extends Controller
{
    public function renderHtml($classname = "Main")
    {
        $viewData  = array_merge(
            $this->model->get_AppLibs($classname),
            $this->model->get_VendorLibs($classname)
        );

        $this->view->renderView("html.php", $viewData);
    }

    public function renderHeader()
    {
        $this->view->renderView("header.php");
    }

    public function renderFooter()
    {
        $this->view->renderView("footer.php");
    }

    public function homePage()
    {
        $this->view->viewFile = "home.php";
        $this->renderSite(array($this->view));
    }
}
