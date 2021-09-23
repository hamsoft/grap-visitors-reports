<?php

namespace Framework;

class Config
{

    private File $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function get($key, $default = null)
    {
        $parts = explode('.', $key);

        $configs = $this->file->readFile(__DIR__ . '/../config/' . array_shift($parts) . '.php');
                
        while(isset($configs) && !empty($parts)) {
            $configs = $configs[array_shift($parts)] ?? null;
        }
        
        return $configs ?? $default;
    }

}