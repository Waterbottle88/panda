<?php

namespace App\Model;

use App\Database\Database;

class Subscription
{
    protected $email;
    protected $adId;

    public function __construct($email, $adId)
    {
        $this->email = $email;
        $this->adId = $adId;
    }

    public function save()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO subscription (email, ad_id) VALUES (:email, :ad_id)");
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':ad_id', $this->adId);
        
        return $stmt->execute();
    }

    public static function getSubscribersByAdId($adId)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT email FROM subscription WHERE ad_id = :ad_id");
        $stmt->bindParam(':ad_id', $adId);
        $stmt->execute();

        $subscribers = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $subscribers;
    }
}
