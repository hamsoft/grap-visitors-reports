<?php

namespace Framework;

interface Container
{
    public function make($abstract): mixed;

    public function singleton($abstract,  $instance = null): Container;

}