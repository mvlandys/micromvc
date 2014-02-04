<?php
	namespace Matheos\App;

	class Alert extends \Matheos\MicroMVC\Controller {
        public function cBox_Alert( $Alert, $Type, $Code, $Refresh=null ) {
            $viewData = array(
                "Alert"   => $Alert,
                "Type"    => $Type,
                "Refresh" => $Refresh
            );

            $this->view->renderView("cBox_alert.php", $viewData);
        }

        public function page_Alert( $Alert, $Type, $Code ) {
            $viewData = array(
                "Alert" => $Alert,
                "Type"  => $Type
            );

            $this->view->renderView("page_alert.php", $viewData);
        }
	}
