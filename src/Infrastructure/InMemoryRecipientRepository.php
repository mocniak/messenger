<?php
namespace App\Infrastructure;

use App\Domain\Recipient;
use App\Domain\RecipientRepository;

class InMemoryRecipientRepository implements RecipientRepository
{
    /** @var Recipient[]  */
    private array $recipients;

    public function save(Recipient $recipient): void
    {
        $this->recipients[$recipient->username()] = $recipient;
    }

    public function getByUsername(string $username): Recipient
    {
        return $this->recipients[$username];
    }
}