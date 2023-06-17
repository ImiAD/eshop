<?php
declare(strict_types=1);
error_reporting(-1);
session_start();

require __DIR__ . '/../vendor/autoload.php';

function pr($data): void
{
	echo '<pre>'; print_r($data); echo '</pre>';
}

function vd($data): void
{
    var_dump($data);
}

try {
	$config = \App\Core\Config::getInstance();

	echo (new \App\Core\Routing\Route())->run($config);
} catch (\Exception $e) {
	echo $e->getMessage();
}

