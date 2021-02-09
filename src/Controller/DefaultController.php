<?php

namespace App\Controller;

use App\Domain\MessengerService;
use App\Domain\PhoneNumber;
use App\Domain\Recipient;
use App\Domain\RecipientRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    private RecipientRepository $recipientRepository;
    private MessengerService $messengerService;

    public function __construct(RecipientRepository $recipientRepository,MessengerService $messengerService)
    {
        $this->recipientRepository = $recipientRepository;
        $this->messengerService = $messengerService;
    }

    /**
     * @Route("/notify/{phoneNumber}", name="app_notify")
     */
    public function notify(string $phoneNumber): Response
    {
        $username = "Test Recipient";
        $recipient = new Recipient($username);
        $recipient->addSmsNumber(new PhoneNumber($phoneNumber));
        $this->recipientRepository->save($recipient);
        $this->messengerService->notify($username, "TestMessage");
        return new Response(
            '<html><body>Message sent</body></html>'
        );
    }
}