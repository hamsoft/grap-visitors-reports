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
        
        $configPath = 'config/' . array_shift($parts) . '.php';

        $configs = $this->file->readFile($configPath);
                
        while(isset($configs) && !empty($parts)) {
            $configs = $configs[array_shift($parts)] ?? null;
        }
        
        return $configs ?? $default;
    }

}