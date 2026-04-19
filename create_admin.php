<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = 'admin@elecshop.com';
$user = User::where('email', $email)->first();

if (!$user) {
    echo "Creating user...";
    $user = new User();
    $user->email = $email;
} else {
    echo "Updating user...";
}

$user->name = 'Admin ElecShop';
$user->password = Hash::make('password123');
$user->role = 'admin';
$user->save();

echo "Done! User ID: " . $user->id;
