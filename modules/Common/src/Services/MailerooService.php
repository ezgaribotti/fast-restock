<?php

namespace Modules\Common\src\Services;

use Illuminate\Mail\Mailable;
use Maileroo\EmailAddress;
use Maileroo\MailerooClient;
use Modules\Common\src\Interfaces\MailerooServiceInterface;

class MailerooService implements MailerooServiceInterface
{
    public function send(string $address, string $displayName, Mailable $mailable): string
    {
        $from = config_as_object('mail.from');

        $envelope = $mailable->envelope();
        $html = $mailable->render();

        $payload = [
            'from' => new EmailAddress($from->address, $from->name),
            'to' => [new EmailAddress($address, $displayName)],
            'subject' => $envelope->subject,
            'html' => $html,
        ];

        $apiKey = config('maileroo.api_key');

        try {
            $client = new MailerooClient($apiKey);
            $referenceId = $client->sendBasicEmail($payload);

        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());

            abort(500, 'Error trying to send the email.');
        }
        return $referenceId;
    }
}
