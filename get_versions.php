<?php
$data = json_decode(file_get_contents('https://repo.packagist.org/p2/laravel/framework.json'), true);
$packages = $data['packages']['laravel/framework'];
$versions = array();
foreach ($packages as $pkg) {
    $versions[] = $pkg['version'];
}
print_r(array_slice($versions, 0, 50));
