<?php
namespace App\Tests\Behat;

use App\Domain\Channels\ActiveChannels;
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
    private ActiveChannels $activeChannels;

    public function __construct(
        RecipientRepository $recipientRepository,
        MessengerService $messengerService,
        EmailInbox $emailInbox,
        SmsInbox $smsInbox,
        ActiveChannels $activeChannels
    ) {
        $this->recipientRepository = $recipientRepository;
        $this->messengerService = $messengerService;
        $this->emailInbox = $emailInbox;
        $this->smsInbox = $smsInbox;
        $this->activeChannels = $activeChannels;
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


    /**
     * @Given SMS service is disabled
     */
    public function smsServiceIsDisabled()
    {
        $this->activeChannels->disable(ActiveChannels::CHANNEL_SMS);
    }

    /**
     * @Then recipient :username have NOT received a SMS
     */
    public function recipientHaveNotReceivedASms(string $username)
    {
        $recipient = $this->recipientRepository->getByUsername($username);
        Assert::null($this->smsInbox->getLastSms($recipient->smsNumber()));
    }

    /**
     * @Given email service is disabled
     */
    public function emailServiceIsDisabled()
    {
        $this->activeChannels->disable(ActiveChannels::CHANNEL_EMAIL);
    }

    /**
     * @Then recipient :username have NOT received an email
     */
    public function recipientHaveNotReceivedAnEmail(string $username)
    {
        $recipient = $this->recipientRepository->getByUsername($username);
        Assert::null($this->emailInbox->getLastEmail($recipient->email()));    }

}
