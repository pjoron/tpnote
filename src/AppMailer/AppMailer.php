<?php

namespace App\Mailer;

use App\Entity\Appartement;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;


class AppMailer
{
    private $mailer;
    private $fromEmail;

    public function __construct(MailerInterface $mailer, string $fromEmail)
    {
        $this->mailer = $mailer;
        $this->fromEmail = $fromEmail;
    }

    public function sendNewAppartementNotification(Appartement $appartement, array $users)
    {
        $email = (new TemplatedEmail())
            ->from($this->fromEmail)
            ->subject('Nouvel appartement ajouté')
            ->htmlTemplate('email/new_appartement.html.twig')
            ->context([
                'appartement' => $appartement
            ]);

        foreach ($users as $user) {
            $email->addTo($user->getEmail());
        }

        $this->mailer->send($email);
    }
}
