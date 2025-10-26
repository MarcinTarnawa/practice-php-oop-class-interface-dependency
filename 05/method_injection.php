<?php

require 'index.php';

class SubscriptionMethod
{
    public function subscribe(CampaignMonitorProvider $provider)
    {
        $provider->addToList('Method List', 'emailmethod@test.com');
        echo "<br>";
        echo 'Add subscribe to CampaignMonitorProvider by method Injection';
    }
}

$newsletter = new SubscriptionMethod();

$cmProvider = new CampaignMonitorProvider();
$newsletter->subscribe($cmProvider);