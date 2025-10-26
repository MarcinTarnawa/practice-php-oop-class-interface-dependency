<?php

interface NewsletterProvider {
    public function addToList(string $listName, string $email): void;
}

class CampaignMonitorProvider implements NewsletterProvider {
    public function addToList(string $listName, string $email): void 
    {
        echo "Add e-mail: {$email} to list: {$listName} with CampaignMonitorProvider.\n";
    }
}

class PostMarkProvider implements NewsletterProvider {
    public function addToList(string $listName, string $email): void 
    {
        echo "Add e-mail: {$email} to list: {$listName} with PostMarkProvider.\n";
    }
}

?>
<a href="method_injection.php">Method injection</a><br>
<a href="construct_injection.php">Construct injection</a>
<br>