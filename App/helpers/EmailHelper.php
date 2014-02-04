<?php

    namespace Matheos\App;

    class EmailHelper {
        protected $mailer;

        function __construct() {
            $AppConfig = \Matheos\MicroMVC\AppConfig::getInstance();

            $this->mailer           = new \PHPMailer(true);
            $this->mailer->Host     = $AppConfig->config->Mail->host;
            $this->mailer->Port     = 25;
            $this->mailer->SMTPAuth = $AppConfig->config->Mail->host;

            if ($this->mailer->SMTPAuth = "true") {
                $this->mailer->SMTPSecure   = "tls";
                $this->mailer->Username     = $AppConfig->config->Mail->username;
                $this->mailer->Password     = $AppConfig->config->Mail->password;
                $this->mailer->IsSMTP();
            }

            $this->mailer->SetFrom("me@website.com", "MicroMVC Framework");
        }

        public function get_Mailer() {
            return $this->mailer;
        }
    }