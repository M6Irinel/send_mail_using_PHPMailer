<?php

namespace Helpers;

use InvalidArgumentException;

class Env {
    static public function read(string $path = __DIR__ . '/../../.env'){
        if(!file_exists($path))
            throw new InvalidArgumentException(sprintf('%s not exists', $path));

        if(!is_readable($path))
            throw new InvalidArgumentException(sprintf('%s is not readable', $path));

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        $env = [];
        foreach($lines as $line){
            if(strpos(trim($line), '#') === 0) continue;

            list($key, $value) = explode('=', $line, 2);
            $env[trim($key)] = trim($value);
        }

        return $env;
    }
}