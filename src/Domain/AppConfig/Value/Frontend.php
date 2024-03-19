<?php

declare(strict_types=1);

namespace DcGen\Domain\AppConfig\Value;

enum Frontend
{
    case VANILLA;
    case REACT;
    case VUE;
    case ANGULAR;
    case SVELTE;
    case SOLID;
}
