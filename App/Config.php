<?php

namespace App;

use Dallgoot\Yaml\Yaml;

class Config
{
    public bool $isDev = false;
    public int $buildTime = 0;
    public string $environment = 'development';

    public static string $configFile = __DIR__ . '/../app.yaml';

    public function __construct()
    {
        $yaml = self::readFile();

        $this->environment = $yaml->environment;
        $this->isDev = $this->environment === 'development';
        $this->buildTime = $yaml->buildTime;
    }

    public static function readFile()
    {
        return Yaml::parseFile(self::$configFile);
    }
}
