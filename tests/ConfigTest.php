<?php

namespace Tests;

use Framework\Config;
use Framework\File;

class ConfigTest extends TestCase
{

    public function testGet()
    {
        $file = $this->createStub(File::class);

        $filledConfig = ['first-level' => ['second-level' => 'test']];

        $file->method('readFile')->willReturn(null, [], $filledConfig, $filledConfig, $filledConfig);

        $config = new Config($file);

        $this->assertNull($config->get('config-file'));

        $this->assertEquals([], $config->get('config-file'));

        $this->assertEquals(['second-level' => 'test'], $config->get('config-file.first-level'));

        $this->assertEquals('test', $config->get('config-file.first-level.second-level'));

        $this->assertNull($config->get('config-file.first-level.something'));
    }
}
