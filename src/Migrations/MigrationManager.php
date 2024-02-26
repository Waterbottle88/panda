<?php

namespace App\Migration;
use App\Database\Database;

class MigrationManager
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function migrate(Migration $migration)
    {
        try {
            $migration->up($this->pdo);
            echo "Migration Successful.\n";
        } catch (\Exception $exception) {
            echo "Migration Failed: " . $exception->getMessage() . "\n";
        }
    }

    public function rollback(Migration $migration)
    {
        try {
            $migration->down($this->pdo);
            echo "Rollback Successful.\n";
        } catch (\Exception $exception) {
            echo "Rollback Failed: " . $exception->getMessage() . "\n";
        }
    }
}
