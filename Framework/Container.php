<?php

namespace Framework;

interface Container
{
    public function make($abstract, array $params = []): mixed;

    public function singleton($abstract,  $instance = null): Container;

}