<?php
namespace App\Service;
use App\Entity\Transaction;
use App\Storage\JsonStorage;


class PortfolioService {
    public function __construct(private JsonStorage $storage)
    {
        
    }
    public function addTransaction(Transaction $t): void{
       $this->storage->addTransaction($t);
    }
    public function getSummary() : int {
        return array_reduce($this->storage->getAllTransactions(), function (int $carry, Transaction $transaction) {
            return $carry + $transaction->amountInCents;
        }, 0);
    }
}