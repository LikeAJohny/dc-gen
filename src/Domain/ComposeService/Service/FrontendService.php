<?php

declare(strict_types=1);

namespace DcGen\Domain\ComposeService\Service;

use DcGen\Domain\AppConfig\AppConfig;
use DcGen\Domain\AppConfig\Value\Frontend;
use DcGen\Domain\ComposeService\ComposeService;

class FrontendService
{
    public function generate(AppConfig $config): ComposeService
    {
        return match ($config->frontend) {
            Frontend::REACT => $this->react($config),
            default => $this->react($config),
        };
    }

    private function react(AppConfig $config): ComposeService
    {
        $name = $config->appName;
        $dependencies = [];

        if ($config->database) {
            $dependencies[] = 'db';
        }

        if ($config->backend) {
            $dependencies[] = "$name-api";
        }

        return new ComposeService(
            name: "$name-app",
            containerName: "$name-app",
            image: 'node:alpine',
            workingDir: '/app',
            volumes: ['./:/app:rw'],
            networks: ["$name-internal"],
            expose: [5173],
            dependsOn: $dependencies,
            links: $dependencies,
            cmd: 'vite',
        );
    }
}
