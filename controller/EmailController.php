<?php

namespace controller;

use exceptions\EmailException;

/**
 * EmailController - dirige el envío de correos
 */
class EmailController
{
    private array $data;

    public function __construct()
    {
        $this->data = [
            'error_email' => null,
        ];
    }

    public function manejarEmail($input): array
    {
        $to = $input['destinatario'];
        $subject = $input['asunto'];
        $msg = $input['mensaje'];

        $headers = 'From: pabdevtest@gmail.com' . "\r\n" .
            'Reply-To: pabdevtest@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        // intentar enviar el correo
        try {
            if (!mail($to, $subject, $msg, $headers)) {
                throw new EmailException("Error al enviar correo.");
            }
        } catch (EmailException $ex) {
            $this->data['error_email'] = $ex->getMessage();
        } catch (\Exception $ex) {
            $this->data['error_email'] = $ex->getMessage();
        }

        return $this->data;
    }
}