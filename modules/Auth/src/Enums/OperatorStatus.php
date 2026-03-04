<?php

namespace Modules\Auth\src\Enums;

enum OperatorStatus: string
{
    case Active = 'active';
    case Suspended = 'suspended';
    case Blocked = 'blocked';
}
