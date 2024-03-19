<?php

declare(strict_types=1);

namespace DcGen\Domain\Install;

use DcGen\Domain\AppConfig\AppConfig;

interface AppInstaller
{
    public function install(AppConfig $config): string;
}
