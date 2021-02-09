<?php
namespace App\Tests\Behat;

use App\Domain\EmailInbox;
use App\Domain\MessengerService;
use App\Domain\Recipient;
use App\Domain\RecipientRepository;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    const MESSAGE_CONTENT = "Message content";
    private RecipientRepository $recipientRepository;
    private MessengerService $messengerService;
    /**
     * @var EmailInbox
     */
    private EmailInbox $emailInbox;

    public function __construct(
        RecipientRepository $recipientRepository,
        MessengerService $messengerService,
        EmailInbox $emailInbox
    ) {
        $this->recipientRepository = $recipientRepository;
        $this->messengerService = $messengerService;
        $this->emailInbox = $emailInbox;
    }

    /**
     * @Given there is a recipient :username
     */
    public function thereIsARecipient(string $username)
    {
        $this->recipientRepository->save(new Recipient($username));
    }

    /**
     * @Given recipient :username have configured email notifications
     */
    public function recipientHaveConfiguredEmailNotifications(string $username)
    {
        $recipient = $this->recipientRepository->getByUsername($username);
        $recipient->addEmail($recipient->username() . '@example.com');
    }

    /**
     * @When I message recipient :username
     */
    public function iMessageRecipient(string $username)
    {
        $this->messengerService->notify($username, self::MESSAGE_CONTENT);
    }

    /**
     * @Then recipient :username have received an email
     */
    public function recipientHaveReceivedAnEmail($username)
    {
        $recipient = $this->recipientRepository->getByUsername($username);
        Assert::eq($this->emailInbox->getLastEmail($recipient->email()), self::MESSAGE_CONTENT);
    }
}