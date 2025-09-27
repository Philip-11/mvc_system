<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/../../bootstrap.php';
require BASE_PATH . '/vendor/autoload.php';


class Mailer
{
    private $mail;
    private $config;

    public function __construct()
    {
        $config = require BASE_PATH . '/config/config.php';

        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();

        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $config['username'];
        $this->mail->Password = $config['password'];
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;

        $this->mail->setFrom('kmortalxl@gmail.com', 'Magsaysay Philip');
        $this->mail->isHTML(true);
    }

    public function sendTemplate($to, $subject, $templatePath, $data = [])
    {
        try {
            $body = file_get_contents($templatePath);

            //Replace {{ }}
            foreach ($data as $key => $value) {
                $body = str_replace('{{' . $key . '}}', $value, $body);
            }

            $this->mail->clearAddresses();
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            return $this->mail->send();
        } catch (Exception $e) {
            error_log("Error on Mailer: {$this->mail->ErrorInfo}");
            return false;
        }
    }
}
