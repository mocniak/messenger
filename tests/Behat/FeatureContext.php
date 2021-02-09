<?php
namespace App\Tests\Behat;

use App\Domain\EmailInbox;
use App\Domain\MessengerService;
use App\Domain\PhoneNumber;
use App\Domain\Recipient;
use App\Domain\RecipientRepository;
use App\Domain\SmsInbox;
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
    private EmailInbox $emailInbox;
    private SmsInbox $smsInbox;

    public function __construct(
        RecipientRepository $recipientRepository,
        MessengerService $messengerService,
        EmailInbox $emailInbox,
        SmsInbox $smsInbox
    ) {
        $this->recipientRepository = $recipientRepository;
        $this->messengerService = $messengerService;
        $this->emailInbox = $emailInbox;
        $this->smsInbox = $smsInbox;
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


    /**
     * @Given recipient :username have configured SMS notifications
     */
    public function recipientHaveConfiguredSmsNotifications(string $username)
    {
        $recipient = $this->recipientRepository->getByUsername($username);
        $recipient->addSmsNumber(new PhoneNumber("+48790722761"));
    }

    /**
     * @Then recipient :username have received a SMS
     */
    public function recipientHaveReceivedASms(string $username)
    {
        $recipient = $this->recipientRepository->getByUsername($username);
        Assert::eq($this->smsInbox->getLastSms($recipient->smsNumber()), self::MESSAGE_CONTENT);
    }
}
