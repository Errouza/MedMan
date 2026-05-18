<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$p = \App\Models\Patient::latest()->first();
if(!$p) { echo 'No patient'; exit; }
echo 'Old: ' . $p->created_at . PHP_EOL;
$p->status = 'waiting';
$p->created_at = now();
$p->save();
$p->refresh();
echo 'New: ' . $p->created_at . PHP_EOL;
