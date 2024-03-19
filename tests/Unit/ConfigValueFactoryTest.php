<?php

declare(strict_types=1);

namespace UnitTests;

use DcGen\Domain\AppConfig\Value\Backend;
use DcGen\Domain\AppConfig\Value\ConfigValueFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function strtolower;

class ConfigValueFactoryTest extends TestCase
{
    #[DataProvider('backends')]
    public function testCreatesAllKnownBackends(string $backend): void
    {
        $value = ConfigValueFactory::backend($backend);
        $this->assertInstanceOf(Backend::class, $value);
    }

    public static function backends(): array
    {
        return array_map(
            static fn(Backend $backend) => [
                'backend' => strtolower(
                    $backend->name
                ),
            ],
            Backend::cases()
        );
    }
}
