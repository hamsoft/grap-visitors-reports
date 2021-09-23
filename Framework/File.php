<?php

namespace Framework;

class File
{

    public function readFile($path)
    {
        return file_exists($path) ? require $path : null;
    }

}