<?php

declare(strict_types=1);

namespace DcGen\Application\GenerateComposeFile;

use DcGen\Domain\AppConfig\AppConfig;
use DcGen\Domain\AppConfig\Value\ConfigValueFactory;
use DcGen\Domain\ComposeFile\ComposeFile;
use DcGen\Domain\ComposeService\Service\BackendService;
use DcGen\Domain\ComposeService\Service\DatabaseService;
use DcGen\Domain\ComposeService\Service\FrontendService;

class GenerateComposeFileHandler
{
    public function __construct(
        private readonly DatabaseService $databaseService,
        private readonly BackendService $backendService,
        private readonly FrontendService $frontendService,
//        private readonly AppInstaller $appInstaller,
    )
    {
    }

    public function exec(GenerateComposeFileCommand $command): ComposeFile
    {
        $config = new AppConfig(
            $command->appName,
            $command->appPath,
            ConfigValueFactory::database($command->database),
            ConfigValueFactory::backend($command->backend),
            ConfigValueFactory::frontend($command->frontend),
        );

        $database = $this->databaseService->generate($config);
        $backend = $this->backendService->generate($config);
        $frontend = $this->frontendService->generate($config);
//        $this->appInstaller->install($config);

        return new ComposeFile(
            services: [$database, $backend, $frontend],
            networks: ["$config->appName-internal"]
        );
    }
}
