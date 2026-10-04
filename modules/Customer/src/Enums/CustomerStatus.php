<?php

namespace Modules\Customer\src\Enums;

enum CustomerStatus: string
{
    case Active = 'active';
    case Banned = 'banned';
}
