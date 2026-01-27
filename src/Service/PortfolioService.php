<?php 
namespace App\Service;
use App\Entity\Transaction;
use App\Storage\StorageInterface;
class PortfolioService {
    // Inject the INTERFACE, not the CLASS
    public function __construct(private StorageInterface $storage) {}

    public function addTransaction(Transaction $t): void {
        $this->storage->addTransaction($t);
    }

    public function getSummary(): array {
        $transactions = $this->storage->getAllTransactions();
        $total = array_reduce($transactions, fn($carry, $t) => $carry + $t->amountInCents, 0);
        
        return [
            'total' => $total,
            'count' => count($transactions)
        ];
    }
}