<?php

require 'index.php';

class Subscription
{
    public NewsletterProvider $provider;

    public function __construct(NewsletterProvider $provider)
    {
        $this->provider = $provider;
    }

    public function subscribe($listName, $email)
    {
        $this->provider->addToList($listName, $email);
        
        echo "Add {$email} to subscribe.<br> ";
    }

    public function confirmToSubscribe($userName)
    {
        echo "User {$userName} succesfuly added to subscribe!<br>";
    }
}

$userName = "Marcin";
$email = 'construct@email.com';

$PostMarkProvider = new PostMarkProvider();
$constructProvider = new Subscription($PostMarkProvider);
$constructProvider->subscribe($userName , $email);
$constructProvider->confirmToSubscribe($userName);

$campingMonitorProvider = new CampaignMonitorProvider();
$constructProvider2 = new Subscription($campingMonitorProvider);
$constructProvider2->subscribe($userName , $email);
$constructProvider2->confirmToSubscribe($userName);