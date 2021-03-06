<?php
namespace Matheos\App;

use Matheos\MicroMVC\Controller;

class Alert extends Controller
{
    /*
     *  Renders an Alert-View fit for a colorbox popup
     *
     *  @param string $alert
     *  @param string $type
     *  @param int $refresh
     */
    public function cBox_Alert($alert, $type, $refresh = null)
    {
        $viewData = array(
            "alert-msg"  => $alert,
            "alert-type" => $type,
            "refresh"    => $refresh
        );

        $this->view->renderView("cBox_alert.php", $viewData);
    }

    /*
     *  Renders an Alert-View
     *
     *  @param string $alert
     *  @param string $type
     */
    public function page_Alert($alert, $type)
    {
        $viewData = array(
            "alert-msg"  => $alert,
            "alert-type" => $type
        );

        $this->view->renderView("page_alert.php", $viewData);
    }
}
