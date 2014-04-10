<?php
namespace Matheos\App;

use Matheos\MicroMVC\Controller;

class Main extends Controller
{
    /*
     *  Renders the html/header blocks
     *  Includes css & javascript links
     *
     *  @param string $classname
     */
    public function renderHtml($classname = "Main")
    {
        $viewData  = array_merge(
            $this->model->get_AppLibs($classname),
            $this->model->get_VendorLibs($classname)
        );

        $this->view->renderView("html.php", $viewData);
    }

    /*
     *  Renders the site's header view
     *  Typically used for nav-bars
     */
    public function renderHeader()
    {
        $this->view->renderView("header.php");
    }

    /*
     *  Renders the site's footer
     */
    public function renderFooter()
    {
        $this->view->renderView("footer.php");
    }

    /*
     *  Renders the homepage view
     */
    public function homePage()
    {
        $this->view->viewFile = "home.php";
        $this->renderSite(array($this->view));
    }
}
