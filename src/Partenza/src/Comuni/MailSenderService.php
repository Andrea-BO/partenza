<?php

declare(strict_types=1);

namespace Partenza\Comuni;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MailSenderService
{
    private $configMail;
    private $parametriMail;

    public function __construct(array $dati_mail){
        $this->configMail = $dati_mail;
    }

    public function setBodyAndSend ($parametriMail) {
        // var_dump($parametriMail, $this->configMail);
        // return        null;


        $nomeTemplate = 'template-my-mail';
        $checkFileTemplate = [];
        if(!file_exists($this->configMail['pathTemplate'].$nomeTemplate.'.html'))
            array_push($checkFileTemplate, 'File del template HTML mancante: '.$nomeTemplate.'.html');
        if(!file_exists($this->configMail['pathTemplate'].$nomeTemplate.'.txt'))
            array_push($checkFileTemplate, 'File del template TXT mancante: '.$nomeTemplate.'.txt');
        if(!empty($checkFileTemplate)){
            $esitoInvio = [
                'inviato' => false,
                'err' => implode(', ', $checkFileTemplate),
            ];
            return $esitoInvio;
        }

        // setting oggetto
        $subject = 'Nuova Mail di Partenza';

        // setting corpo
        $body = $this->generaBody($parametriMail);
        if(empty($body)){
            $esitoInvio = [
                'inviato' => false,
                'err' => 'Generazione body fallita per il template '.$parametriMail['template']['modello'],
            ];
            return $esitoInvio;
        }

        $this->parametriMail = [
            'to' => $parametriMail['template']['destinatari'],
            'subject' => $subject,
            'corpo' => $body,
        ];
        // return null;

        return $this->spedisciMail();
    }


    private function generaBody($parametriMail){
        $body = [];
        $nomeTemplate = 'template-my-mail';
        $arrMailTemplate = ['html', 'txt'];

        // popolamento template
        foreach($arrMailTemplate as $k => $template) {
            $body[$template] = file_get_contents($this->configMail['pathTemplate'].$nomeTemplate.'.'.$template);
            foreach($parametriMail as $elemento => $valore){
                if($elemento === 'template')
                    continue;
                $body[$template] = str_replace('%%'.$elemento.'%%', $valore, $body[$template]);
            }
        }

        return $body;
    }

    private function spedisciMail()
    {
        $esitoInvio = [
            'inviato' => true,
            'err' => '',
        ];

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;     // DEBUG_SERVER - DEBUG_*
            $mail->isSMTP();                        // Send using SMTP
            $mail->Host = $this->configMail['smtp'];  // Set the SMTP server to send through
            $mail->Port = $this->configMail['porta'];  // 587 - 465

            //Recipients
            $mail->setFrom($this->configMail['from']);
            foreach($this->parametriMail['to'] as $k => $destinatario) {
                $mail->addAddress($destinatario);
            }

            // Content
            $mail->isHTML(true);    // Set email format to HTML
            $mail->Subject = $this->parametriMail['subject'];
            $mail->Body = $this->parametriMail['corpo']['html'];
            $mail->AltBody = $this->parametriMail['corpo']['txt'];

            $mail->send();

        } catch (PHPMailerException $e) {
            \Sentry\captureException($e);

            $esitoInvio = [
                'inviato' => false,
                'err' => $mail->ErrorInfo,
            ];
        }

        return $esitoInvio;
    }

}