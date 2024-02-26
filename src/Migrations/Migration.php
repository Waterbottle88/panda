<?php

namespace App\Migration;

interface Migration
{
    public function up(\PDO $pdo);
    public function down(\PDO $pdo);
}