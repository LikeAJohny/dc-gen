<?php

declare(strict_types=1);

namespace DcGen\Domain\ComposeService;

use function explode;
use function join;
use function sprintf;

readonly class ComposeService
{
    public function __construct(
        public string $name,
        public string $containerName,
        public string $image,
        public string $restart = 'unless-stopped',
        public ?string $workingDir = null,
        public ?array $volumes = null,
        public ?array $networks = null,
        public ?array $ports = null,
        public ?array $expose = null,
        public ?array $environment = null,
        public ?array $dependsOn = null,
        public ?array $links = null,
        public ?string $entryPoint = null,
        public ?string $cmd = null,
    ) {
    }

    public function toArray(): array
    {
        $attributes = [
            'container_name' => $this->containerName,
            'image' => $this->image,
            'restart' => $this->restart,
        ];

        if ($this->workingDir) {
            $attributes['working_dir'] = $this->workingDir;
        }

        if ($this->volumes) {
            $attributes['volumes'] = $this->volumes;
        }

        if ($this->networks) {
            $attributes['networks'] = $this->networks;
        }

        if ($this->ports) {
            $attributes['ports'] = $this->ports;
        }

        if ($this->expose) {
            $attributes['expose'] = $this->expose;
        }

        if ($this->environment) {
            $attributes['environment'] = $this->environment;
        }

        if ($this->dependsOn) {
            $attributes['depends_on'] = $this->dependsOn;
        }

        if ($this->links) {
            $attributes['links'] = $this->links;
        }

        if ($this->entryPoint) {
            $parts = explode(' ', $this->entryPoint);
            $attributes['entrypoint'] = sprintf('["%s"]', join('", "', $parts));
        }

        if ($this->cmd) {
            $parts = explode(' ', $this->cmd);
            $attributes['cmd'] = sprintf('["%s"]', join('", "', $parts));
        }

        return [$this->name => $attributes];
    }
}
