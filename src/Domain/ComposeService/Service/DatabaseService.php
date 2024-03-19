<?php

declare(strict_types=1);

namespace DcGen\Domain\ComposeService\Service;

use DcGen\Domain\AppConfig\AppConfig;
use DcGen\Domain\AppConfig\Value\Database;
use DcGen\Domain\ComposeService\ComposeService;
use InvalidArgumentException;

class DatabaseService
{
    /**
     * @throws InvalidArgumentException
     */
    public function generate(AppConfig $config): ComposeService
    {
        return match ($config->database) {
            Database::POSTGRES => $this->postgres($config),
            Database::MARIADB => $this->mariadb($config),
            Database::MYSQL => $this->mysql($config),
            default => throw new InvalidArgumentException('Unknown Database'),
        };
    }

    private function postgres(AppConfig $config): ComposeService
    {
        $name = $config->appName;

        return new ComposeService(
            name: "$name-db",
            containerName: "$name-db",
            image: 'postgres:alpine',
            workingDir: '/app',
            volumes: ['./:/app:rw'],
            networks: ["$name-internal"],
            expose: [5432],
        );
    }

    private function mariadb(AppConfig $config): ComposeService
    {
        $name = $config->appName;

        return new ComposeService(
            name: "$name-db",
            containerName: "$name-db",
            image: 'mariadb:alpine',
            workingDir: '/app',
            volumes: ['./:/app:rw'],
            networks: ["$name-internal"],
            expose: [3306],
        );
    }

    private function mysql(AppConfig $config): ComposeService
    {
        $name = $config->appName;

        return new ComposeService(
            name: "$name-db",
            containerName: "$name-db",
            image: 'mysql:alpine',
            workingDir: '/app',
            volumes: ['./:/app:rw'],
            networks: ["$name-internal"],
            expose: [3306],
        );
    }
}
