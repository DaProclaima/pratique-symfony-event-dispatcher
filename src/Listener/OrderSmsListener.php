<?php


namespace App\Listener;


use App\Event\OrderEvent;
use App\Logger;
use App\Model\Order;
use App\Texter\Sms;
use App\Texter\SmsTexter;

class OrderSmsListener
{
    protected $texter;
    protected $logger;

    /**
     * OrderSmsListener constructor.
     * @param $texter
     * @param $logger
     */
    public function __construct(SmsTexter $texter, Logger $logger)
    {
        $this->texter = $texter;
        $this->logger = $logger;
    }


    public function sendSmsToCustomer(OrderEvent $event) {
        $order = $event->getOrder();
        // Après enregistrement on veut aussi envoyer un SMS au client
        // voir src/Texter/Sms.php et /src/Texter/SmsTexter.php
        $sms = new Sms();
        $sms->setNumber($order->getPhoneNumber())
            ->setText("Merci pour votre commande de {$order->getQuantity()} {$order->getProduct()} !");
        $this->texter->send($sms);

        // Après SMS au client, on veut logger ce qui se passe :
        // voir src/Logger.php
        $this->logger->log("SMS de confirmation envoyé à {$order->getPhoneNumber()} !");
    }
    public function sendSmsToStock(OrderEvent $event) {
        $order = $event->getOrder();
        // Après enregistrement on veut aussi envoyer un SMS au client
        // voir src/Texter/Sms.php et /src/Texter/SmsTexter.php
        $sms = new Sms();
        $sms->setNumber('06060606060')
            ->setText("Commande de {$order->getQuantity()} de {$order->getProduct()} pour {$order->getPhoneNumber()}!");
        $this->texter->send($sms);

        $this->logger->log("SMS de creation de commande envoyé à l'équipe du stock !");
    }
}