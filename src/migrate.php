<?php

require_once './Migrations/Migration.php';
require_once './Migrations/MigrationManager.php';
require_once './Migrations/create_ads_table.php';
require_once './Migrations/create_subscription_table.php';
require_once './Database/Database.php';


use App\Migration\MigrationManager;
use App\Migration\CreateAdsTable;
use App\Migration\CreateSubscriptionTable;

$migrationManager = new MigrationManager();

$createAdsMigration = new CreateAdsTable();
$createSubscriptionMigration = new CreateSubscriptionTable();

echo "Starting migrations...\n";

echo "Migrating Ads table...\n";
$migrationManager->migrate($createAdsMigration);

echo "Migrating Subscription table...\n";
$migrationManager->migrate($createSubscriptionMigration);

echo "Migration process completed.\n";
?>