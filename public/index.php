<?php
declare(strict_types=1);
error_reporting(-1);
session_start();

require __DIR__ . '/../vendor/autoload.php';

function dd($data): void
{
	echo '<pre>'; print_r($data); echo '</pre>';
}
function dump($data): void
{
    echo '<pre>'; var_dump($data); echo '</pre>';
}

try {
	$config = \App\Core\Config::getInstance();

//	echo (new \App\Core\Routing\Route())->run($config);
	echo (new \App\Core\Routing\Route($config))->run();
} catch (\Exception $e) {
	echo $e->getMessage();
}

