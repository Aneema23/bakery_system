<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$users = \App\Models\User::all();

echo "=== Users in Database ===\n";
foreach ($users as $user) {
    echo "ID: {$user->id}, Name: {$user->name}, Email: {$user->email}, Role: {$user->role}\n";
}

if ($users->count() == 0) {
    echo "No users found in database!\n";
} else {
    echo "\nTotal users: " . $users->count() . "\n";
}
