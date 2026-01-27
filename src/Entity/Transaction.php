<?php
namespace App\Entity;
class Transaction implements \JsonSerializable
{
    
    public function __construct(
        public readonly int $amountInCents, 
        public readonly string $currency,
        public readonly string $description
    ) {

    }
    /**
     * This defines how the object looks when converted to JSON for React.
     */
    public function jsonSerialize(): array
    {
        return [
            'amount' => $this->amountInCents,
            'currency' => $this->currency,
            'description' => $this->description,
            'formatted' => number_format($this->amountInCents / 100, 2) . ' ' . $this->currency
        ];
    }
}