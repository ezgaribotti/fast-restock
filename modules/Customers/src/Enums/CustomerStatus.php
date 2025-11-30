<?php

namespace Modules\Customers\src\Enums;

enum CustomerStatus: string
{
    case Active = 'active';
    case Banned = 'banned';
}
