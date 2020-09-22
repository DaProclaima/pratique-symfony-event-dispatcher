<?php

namespace App\Mailer;

class Mailer
{
    public function send(Email $email)
    {
        dump("------------", "DEBUT D'ENVOI D'EMAIL FICTIF : ", $email, "FIN D'ENVOI D'EMAIL FICTIF");
    }
}
