<?php
	namespace Matheos\App;

    use Matheos\MicroMVC\Controller;

	class Alert extends Controller
    {
        /*
         *
         */
        public function cBox_Alert($Alert, $Type, $Refresh = null)
        {
            $viewData = array(
                "Alert"   => $Alert,
                "Type"    => $Type,
                "Refresh" => $Refresh
            );

            $this->view->renderView("cBox_alert.php", $viewData);
        }

        /*
         *
         */
        public function page_Alert($Alert, $Type)
        {
            $viewData = array(
                "Alert" => $Alert,
                "Type"  => $Type
            );

            $this->view->renderView("page_alert.php", $viewData);
        }
	}
