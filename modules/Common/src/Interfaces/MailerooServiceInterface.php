<?php

namespace Modules\Common\src\Interfaces;

use Illuminate\Mail\Mailable;

interface MailerooServiceInterface
{
    public function send(string $address, string $displayName, Mailable $mailable): string;
}
