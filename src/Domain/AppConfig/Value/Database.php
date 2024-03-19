<?php

declare(strict_types=1);

namespace DcGen\Domain\AppConfig\Value;

enum Database
{
    case POSTGRES;
    case MYSQL;
    case MARIADB;
    case MONGODB;
}
