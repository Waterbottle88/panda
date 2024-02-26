<?php 

namespace App\Migration;

class CreateAdsTable implements Migration
{
    public function up(\PDO $pdo)
    {
        $query = "CREATE TABLE IF NOT EXISTS Ads (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            link VARCHAR(255) NOT NULL,
            price INT NOT NULL
        )";
        $pdo->exec($query);
    }

    public function down(\PDO $pdo)
    {
        $query = "DROP TABLE IF EXISTS Ads";
        $pdo->exec($query);
    }
}