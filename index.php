<?php

require_once __DIR__ . '/assets/php/send_mail.php';

use Php\Email;

Email::send(
    [
        "from_name"     => "Mailer name",
        "to_address"    => "ciao@tre.com",
        "to_name"       => "To name",
        "name_mail"     => "Name mail",
        "content"       => "example_mail"
    ]
);
