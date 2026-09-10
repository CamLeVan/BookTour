<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    DB::statement("ALTER TABLE bookings MODIFY COLUMN status VARCHAR(50) NOT NULL DEFAULT 'pending'");
    echo "Status column altered to VARCHAR(50) successfully!\n";
} catch (\Exception $e) {
    echo "Error altering status: " . $e->getMessage() . "\n";
}

try {
    DB::statement("ALTER TABLE bookings MODIFY COLUMN number_of_people INT NOT NULL DEFAULT 1");
    echo "number_of_people column default set successfully!\n";
} catch (\Exception $e) {
    echo "Error altering number_of_people: " . $e->getMessage() . "\n";
}
