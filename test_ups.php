<?php

require_once 'vendor/autoload.php';

use App\Services\UPSService;

// Test UPS API connection
try {
    $upsService = new UPSService();
    
    echo "Testing UPS API connection...\n";
    
    // Test connection
    $connectionTest = $upsService->testConnection();
    echo "Connection test result: " . json_encode($connectionTest, JSON_PRETTY_PRINT) . "\n";
    
    // Test with sample data
    $fromAddress = [
        'name' => 'Test Shipper',
        'address_line' => '123 Test St',
        'city' => 'Test City',
        'state' => 'CA',
        'postal_code' => '90210',
        'country_code' => 'US'
    ];
    
    $toAddress = [
        'name' => 'Test Recipient',
        'address_line' => '456 Test Ave',
        'city' => 'Test Town',
        'state' => 'NY',
        'postal_code' => '10001',
        'country_code' => 'US'
    ];
    
    $packageDetails = [
        'weight' => 5,
        'length' => 10,
        'width' => 8,
        'height' => 6
    ];
    
    echo "\nTesting getRates method...\n";
    $rates = $upsService->getRates($fromAddress, $toAddress, $packageDetails);
    echo "Rates result: " . json_encode($rates, JSON_PRETTY_PRINT) . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
