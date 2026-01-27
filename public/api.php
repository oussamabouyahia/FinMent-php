<?php 
declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php'; // This loads all your App classes!

use App\Entity\Transaction;
use App\Service\PortfolioService;
use App\Storage\JsonStorage;

header('Content-Type: application/json'); // Tell the browser/React we are sending JSON

// 1. Setup our "Kitchen"
$storage = new JsonStorage();
$service = new PortfolioService($storage);

// 2. Handle the "Orders"
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Send back the summary for the Dashboard
    echo json_encode($service->getSummary());
} 

if ($method === 'POST') {
    // Receive new transaction data from React
    $input = json_decode(file_get_contents('php://input'), true);
    
    $newTransaction = new Transaction(
        (int)$input['amount'],
        $input['currency'],
        $input['description']
    );
    
    $service->addTransaction($newTransaction);
    echo json_encode(['status' => 'success']);
}
// Temporary test in api.php
$service->addTransaction(new \App\Entity\Transaction(5000, 'EUR', 'Test Item'));
echo json_encode($service->getSummary());