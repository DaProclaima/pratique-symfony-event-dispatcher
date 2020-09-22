<?php

namespace App\Texter;

class SmsTexter
{
    public function send(Sms $sms)
    {
        dump("-------------", "DEBUT DE SMS TEXTER FICTIF : ", $sms, "FIN DE SMS TEXTER FICTIF");
    }
}
