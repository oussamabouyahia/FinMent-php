<?php
namespace App\Storage;
use App\Entity\Transaction;

class JsonStorage implements StorageInterface {
    private string $filePath = __DIR__ . '/../../data.json';

    public function addTransaction(Transaction $t): void {
        $data = $this->getAllTransactions();
        $data[] = $t;
        // Save to file as JSON
        file_put_contents($this->filePath, json_encode($data));
    }

    public function getAllTransactions(): array {
        if (!file_exists($this->filePath)) return [];
        
        $json = file_get_contents($this->filePath);
        $decoded = json_decode($json, true) ?: [];
        
        // Convert plain arrays back into Transaction objects
        return array_map(fn($item) => new Transaction(
            $item['amount'], $item['currency'], $item['description']
        ), $decoded);
    }
}
    