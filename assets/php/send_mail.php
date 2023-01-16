<?php

namespace Php;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../helpers/env.php';

use PHPMailer\PHPMailer\PHPMailer;
use Helpers\Env;

class Email
{
    static public function send(array $params = [])
    {
        if (!$params['to_address'] && !$params['content'] && !$params['subject']) return;

        $env = Env::read();

        $mail = new PHPMailer();

        if ($env['MAIL_MAILER'] === 'smtp') {
            $mail->isSMTP();

            $mail->SMTPAuth = true;

            $mail->Host = $env['MAIL_HOST'];
            $mail->Port = $env['MAIL_PORT'];
            $mail->Username = $env['MAIL_USERNAME'];
            $mail->Password = $env['MAIL_PASSWORD'];

            $mail->setFrom($env['MAIL_FROM_ADDRESS'], $params['from_name']);
            $mail->addAddress(trim($params['to_address']), $params['to_name']);

            $mail->WordWrap = 50;

            $mail->isHTML(true);
            $mail->Subject = trim($params['name_mail']);
            $mail->Body = file_get_contents(__DIR__ . "/../templates/" . trim($params['content']) . ".php");

            $mail->send();
        }
    }
}
