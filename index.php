<?php

declare(strict_types=1);

require_once __DIR__ .'/vendor/autoload.php';

set_exception_handler([new \App\Exception\ExceptionHandler(), 'handle']);

$config = \App\Helpers\Config::getFileContent('appf');
var_dump($config);

$application = new \App\Helpers\App();
echo $application->getServerTime()->format('m/d/Y h:i:s') . PHP_EOL;
echo $application->getLogPath() . PHP_EOL;
echo $application->getEnvironment() . PHP_EOL;
echo $application->isDebugMode() . PHP_EOL;
echo $application->isRunningFromConsole() . PHP_EOL;

if($application->isRunningFromConsole()) {
    echo 'from console';
} else {
    echo 'from browser';
}