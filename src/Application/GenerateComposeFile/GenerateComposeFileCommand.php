<?php

declare(strict_types=1);

namespace DcGen\Application\GenerateComposeFile;

readonly class GenerateComposeFileCommand
{
    public function __construct(
        public string $appName,
        public string $appPath,
        public ?string $database = null,
        public ?string $backend = null,
        public ?string $frontend = null,
    ) {
    }
}
