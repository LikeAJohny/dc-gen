<?php

declare(strict_types=1);

namespace DcGen\Domain\ComposeFile;

use DcGen\Domain\ComposeService\ComposeService;

readonly class ComposeFile
{
    public function __construct(
        public string $version = '3.8',
        public array $services = [],
        public array $networks = [],
        public array $volumes = [],
    ) {
    }

    public function toArray(): array
    {
        $services = [];
        /** @var ComposeService $service */
        foreach ($this->services as $service) {
            $services[$service->name] = $service->toArray();
        }

        $networks = [];
        foreach ($this->networks as $network) {
            $networks[$network] = null;
        }

        $volumes = [];
        foreach ($this->volumes as $volume) {
            $volumes[$volume] = null;
        }

        $compose = [
            'version' => $this->version,
            'services' => $services,
            'networks' => $networks,
        ];

        if (count($volumes) >= 1) {
            $compose['volumes'] = $volumes;
        }

        return $compose;
    }
}
