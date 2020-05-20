<?php

declare(strict_types=1);

namespace App\Exception;

use App\Helpers\App;
use ErrorException;
use Throwable;

class ExceptionHandler
{
    public function handle(Throwable $exception): void
    {
        $application = new App;
        if($application->isDebugMode()) {
            var_dump('<pre>'.$exception.'</pre>');
        } else {
            echo "UhOh, this is unexpected. Please try that again.";
        }
        exit;
    }

    public function convertWarningAndNoticesToException($severity, $message, $file, $line)
    {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
}