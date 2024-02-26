<?php

namespace App\Migration;

class CreateSubscriptionTable implements Migration
{
    public function up(\PDO $pdo)
    {
        $query = "CREATE TABLE IF NOT EXISTS subscription (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            ad_id INT(11) UNSIGNED,
            FOREIGN KEY (ad_id) REFERENCES Ads(id)
        )";
        $pdo->exec($query);
    }

    public function down(\PDO $pdo)
    {
        $query = "DROP TABLE IF EXISTS subscription";
        $pdo->exec($query);
    }
}
