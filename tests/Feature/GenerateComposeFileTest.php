<?php

declare(strict_types=1);

namespace FeatureTests;

use DcGen\Application\GenerateComposeFile\GenerateComposeFileCommand;
use DcGen\Application\GenerateComposeFile\GenerateComposeFileHandler;
use DcGen\Domain\ComposeService\Service\BackendService;
use DcGen\Domain\ComposeService\Service\DatabaseService;
use DcGen\Domain\ComposeService\Service\FrontendService;
use PHPUnit\Framework\TestCase;

class GenerateComposeFileTest extends TestCase
{
    public function testGeneratesComposeFile(): void
    {
        $handler = new GenerateComposeFileHandler(
            new DatabaseService(),
            new BackendService(),
            new FrontendService()
        );

        $command = new GenerateComposeFileCommand(
            'app-name',
            'app-path',
            'postgres',
            'mezzio',
            'react'
        );

        $composeFile = $handler->exec($command);

        $this->assertEquals('3.8', $composeFile->version);
        $this->assertCount(3, $composeFile->services);
        $this->assertCount(1, $composeFile->networks);
        $this->assertCount(0, $composeFile->volumes);
    }
}
