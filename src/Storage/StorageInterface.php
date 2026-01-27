<?php
namespace App\Storage;
use App\Entity\Transaction;

interface StorageInterface {
    public function addTransaction(Transaction $t): void;
    /** @return Transaction[] */
    public function getAllTransactions(): array;
}