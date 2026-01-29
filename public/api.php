<?php 
declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php'; // This loads all your App classes!

use App\Entity\Transaction;
use App\Service\PortfolioService;
use App\Storage\JsonStorage;

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Crucial: Apache sometimes pre-pends garbage to the output. 
// This ensures we start with a clean JSON string.
ob_clean();
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
// 1. Setup our "Kitchen"
$storage = new JsonStorage();
$service = new PortfolioService($storage);

// 2. Handle the "Orders"
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    echo json_encode($service->getSummary());
    exit; // STOP execution here so nothing else is echoed
} 

if ($method === 'POST') {
    // ... your post logic
    echo json_encode(['status' => 'success']);
    exit; // STOP execution here
}
// Temporary test in api.php
$service->addTransaction(new \App\Entity\Transaction(5000, 'EUR', 'Test Item'));
echo json_encode($service->getSummary());