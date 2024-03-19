<?php

declare(strict_types=1);

namespace DcGen\Domain\AppConfig\Value;

use function strtolower;

class ConfigValueFactory
{
    public static function database(string $db): ?Database
    {
        foreach (Database::cases() as $dbCase) {
            if (strtolower($db) === strtolower($dbCase->name)) {
                return $dbCase;
            }
        }

        return null;
    }

    public static function backend(string $backend): ?Backend
    {
        foreach (Backend::cases() as $backendCase) {
            if (strtolower($backend) === strtolower($backendCase->name)) {
                return $backendCase;
            }
        }

        return null;
    }

    public static function frontend(string $frontend): ?Frontend
    {
        foreach (Frontend::cases() as $frontendCase) {
            if (strtolower($frontend) === strtolower($frontendCase->name)) {
                return $frontendCase;
            }
        }

        return null;
    }

    public static function proxy(string $proxy): ?Proxy
    {
        foreach (Proxy::cases() as $proxyCase) {
            if (strtolower($proxy) === strtolower($proxyCase->name)) {
                return $proxyCase;
            }
        }

        return null;
    }
}
