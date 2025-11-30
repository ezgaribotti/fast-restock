<?php

namespace Modules\Common\src\Services;

use Maileroo\EmailAddress;
use Maileroo\MailerooClient;

class MailerooService
{
    public static function send(string $address, string $displayName, object $mailable): string
    {
        $from = to_object(config('mail.from'));

        $envelope = $mailable->envelope();
        $html = $mailable->render();

        $payload = [
            'from' => new EmailAddress($from->address, $from->name),
            'to' => [new EmailAddress($address, $displayName)],
            'subject' => $envelope->subject,
            'html' => $html,
        ];

        $apiKey = config('maileroo.api_key');

        $client = new MailerooClient($apiKey);
        try {
            $referenceId = $client->sendBasicEmail($payload);

        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());

            abort(500, 'Error trying to send the email.');
        }
        return $referenceId;
    }
}
