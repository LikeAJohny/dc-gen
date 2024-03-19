<?php

declare(strict_types=1);

namespace DcGen\Domain\AppConfig;

use DcGen\Domain\AppConfig\Value\Backend;
use DcGen\Domain\AppConfig\Value\ConfigValueFactory;
use DcGen\Domain\AppConfig\Value\Database;
use DcGen\Domain\AppConfig\Value\Frontend;
use DcGen\Domain\AppConfig\Value\Proxy;

readonly class AppConfig
{
    public function __construct(
        public string $appName,
        public string $appPath,
        public ?Database $database = null,
        public ?Backend $backend = null,
        public ?Frontend $frontend = null,
        public ?Proxy $proxy = null
    ) {
    }

    public function fromArray(array $config): AppConfig
    {
        return new AppConfig(
            $config['appName'],
            $config['appPath'],
            ConfigValueFactory::database($config['database']),
            ConfigValueFactory::backend($config['backend']),
            ConfigValueFactory::frontend($config['frontend']),
            ConfigValueFactory::proxy($config['proxy']),
        );
    }
}
