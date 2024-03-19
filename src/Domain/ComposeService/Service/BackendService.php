<?php

declare(strict_types=1);

namespace DcGen\Domain\ComposeService\Service;

use DcGen\Domain\AppConfig\AppConfig;
use DcGen\Domain\AppConfig\Value\Backend;
use DcGen\Domain\ComposeService\ComposeService;

class BackendService
{
    public function generate(AppConfig $config): ComposeService
    {
        return match ($config->backend) {
            Backend::MEZZIO => $this->mezzio($config),
            default => $this->mezzio($config),
        };
    }

    private function mezzio(AppConfig $config): ComposeService
    {
        $name = $config->appName;
        $dependencies = $config->database ? ['db'] : null;

        return new ComposeService(
            name: "$name-api",
            containerName: "$name-api",
            image: 'php:fpm-alpine',
            workingDir: '/app',
            volumes: ['./:/app:rw'],
            networks: ["$name-internal"],
            expose: [9000],
            dependsOn: $dependencies,
            links: $dependencies,
            cmd: 'php-fpm -R',
        );
    }
}
