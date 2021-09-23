<?php

namespace Framework;

class File
{

    public function readFile($path)
    {
        return require file_exists($path) ? require $path : null;
    }

}