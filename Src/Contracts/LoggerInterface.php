<?php

namespace App\Contracts;

interface LoggerInterface
{
    /**
     * Based on PSR-3 list of the 8 RFC 5424 exposed method levels:
     * debug, 
     * info, 
     * notice, 
     * warning, 
     * error, 
     * critical, 
     * alert, 
     * emergency
     */

    public function debug(string $message, array $context = []);

    public function info(string $message, array $context = []);

    public function notice(string $message, array $context = []);

    public function warning(string $message, array $context = []);

    public function error(string $message, array $context = []);

    public function critical(string $message, array $context = []);

    public function alert(string $message, array $context = []);

    public function emergency(string $message, array $context = []);
    
    /**
     * log is a simple helper method to capture the level 
     * of method and store the message.
     */    
    public function log(string $level, string $message, array $context = []);
}