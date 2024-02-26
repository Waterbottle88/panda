<?php

namespace App\Model;

use App\Database\Database;

class Ad
{
    protected $link;
    protected $price;
    protected $id;

    public function __construct($link, $price)
    {
        $this->link = $link;
        $this->price = $price;
    }

    public function save()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO Ads (link, price) VALUES (:link, :price)");
        $stmt->bindParam(':link', $this->link);
        $stmt->bindParam(':price', $this->price);
        
        if ($stmt->execute()) {
            $this->id = $conn->lastInsertId();
            return $this->id;
        } else {
            return false;
        }
    }

    public function getId() 
    {
        return $this->id;
    }

    public function getPrice() 
    {
        return $this->price;
    }

    public function getLink() 
    {
        return $this->link;
    }

    public function setPrice($newPrice)
    {
        $this->price = $newPrice;
        return $this->price;
    }

    public static function getAllAds()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->query("SELECT * FROM Ads");
        $ads = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $adObjects = [];

        foreach ($ads as $ad) {
            $adObjects[] = new Ad($ad['link'], $ad['price']);
        }

        return $adObjects;
    }

    public static function findByLink($link)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT id FROM Ads WHERE link = :link");
        $stmt->bindParam(':link', $link);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result && isset($result['id'])) {
            return $result['id'];
        } else {
            return null;
        }
    }
}
