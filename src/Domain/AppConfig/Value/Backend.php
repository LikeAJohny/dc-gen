<?php

declare(strict_types=1);

namespace DcGen\Domain\AppConfig\Value;

enum Backend
{
    case PHP;
    case GO;
    case MEZZIO;
    case LAMINAS;
    case LARAVEL;
    case GIN;
    case FIBRE;
}
