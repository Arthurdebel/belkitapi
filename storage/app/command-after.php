<?php
$paymentConfigPath = function_exists('base_path') ? base_path('config/payments.php') : __DIR__ . '/config/payments.php';
if (file_exists($paymentConfigPath)) {
    $content = file_get_contents($paymentConfigPath);

    if (strpos($content, "'cashfree'") === false) {
        $block = "\n  'cashfree' => \n  array (\n    'status' => 'disable',\n    'app_id' => 'TEST10xxxxxxxxx',\n    'secret_key' => 'cfsk_ma_xxxxxxx',\n    'is_production' => 'false',\n  ),\n";
        $content = preg_replace('/(\s*\)\s*;)\s*$/', $block . '$1', $content, 1);
    }

    if (strpos($content, "'paylink'") === false) {
        $block = "\n  'paylink' => \n  array (\n    'status' => 'disable',\n    'api_id' => 'APP_ID_1xxxxxx',\n    'secret_key' => '0662xxxxxxxxxxx',\n    'is_production' => 'false',\n  ),\n";
        $content = preg_replace('/(\s*\)\s*;)\s*$/', $block . '$1', $content, 1);
    }

    file_put_contents($paymentConfigPath, $content);
}

$path = dirname(__DIR__) . '/resources/lang/index/en.json';
$path = function_exists('resource_path') ? resource_path('lang/index/en.json') : __DIR__ . '/resources/lang/index/en.json';
$data = [];
if (file_exists($path)) {
    $json = file_get_contents($path);
    $decoded = json_decode($json, true);
    if (is_array($decoded)) {
        $data = $decoded;
    }
}
$data['WELL_DOCUMENTED'] = 'Well Documented';
$content = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL;
file_put_contents($path, $content, LOCK_EX);

Artisan::call('route:clear');
Artisan::call('cache:clear');
Artisan::call('config:clear');
Artisan::call('view:clear');
@file_get_contents(url('view-clear'));
@file_get_contents(url('clear-cache'));
@file_get_contents(url('migrate'));
@Artisan::call('migrate');