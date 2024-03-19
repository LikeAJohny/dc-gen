<?php

declare(strict_types=1);

namespace DcGen\Domain\AppConfig\Value;

enum Proxy
{
    case NGINX;
    case APACHE;
    case TRAEFIK;
}
