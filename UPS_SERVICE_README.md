# UPS Service Integration for Laravel

This package provides a comprehensive UPS API integration service for Laravel applications, handling OAuth2 authentication, shipping rates, shipment creation, tracking, and pickup scheduling.

## Features

- **OAuth2 Authentication**: Automatic token management with caching and refresh
- **Shipping Rates**: Get real-time shipping rates for packages
- **Shipment Creation**: Create shipments and generate shipping labels
- **Shipment Tracking**: Track packages with detailed status updates
- **Pickup Scheduling**: Schedule package pickups
- **Environment-based Configuration**: Support for both sandbox and production environments
- **Comprehensive Error Handling**: Detailed error messages and logging
- **Laravel Integration**: Uses Laravel's HTTP client and caching systems

## Installation

### 1. Environment Variables

Add the following variables to your `.env` file:

```env
# UPS API Credentials
UPS_CLIENT_ID=your_ups_client_id
UPS_CLIENT_SECRET=your_ups_client_secret
UPS_ACCOUNT_NUMBER=your_ups_account_number

# Environment (false for sandbox, true for production)
UPS_PRODUCTION=false
```

### 2. Configuration

The service automatically reads from `config/services.php` (already configured) or falls back to environment variables.

### 3. Service Class

The `UPSService` class is located at `app/Services/UPSService.php` and is ready to use.

## Usage

### Basic Instantiation

```php
use App\Services\UPSService;

$ups = new UPSService();
```

### 1. Get Shipping Rates

```php
$fromAddress = [
    'name' => 'John Doe',
    'address_line' => '123 Main St',
    'city' => 'New York',
    'state' => 'NY',
    'postal_code' => '10001',
    'country_code' => 'US'
];

$toAddress = [
    'name' => 'Jane Smith',
    'address_line' => '456 Oak Ave',
    'city' => 'Los Angeles',
    'state' => 'CA',
    'postal_code' => '90210',
    'country_code' => 'US'
];

$packageDetails = [
    'weight' => 5.5,      // in pounds
    'length' => 12,        // in inches
    'width' => 8,          // in inches
    'height' => 6          // in inches
];

try {
    $rates = $ups->getRates($fromAddress, $toAddress, $packageDetails);
    
    foreach ($rates as $rate) {
        echo "Service: {$rate['service_name']}\n";
        echo "Cost: \${$rate['total_charges']} {$rate['currency']}\n";
        echo "Transit Time: {$rate['transit_time']} business days\n\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

### 2. Create Shipment

```php
$fromAddress = [
    'name' => 'ABC Company',
    'attention_name' => 'Shipping Department',
    'address_line' => '789 Business Blvd',
    'city' => 'Chicago',
    'state' => 'IL',
    'postal_code' => '60601',
    'country_code' => 'US',
    'phone' => '555-123-4567'
];

$toAddress = [
    'name' => 'Customer Name',
    'address_line' => '321 Customer St',
    'city' => 'Miami',
    'state' => 'FL',
    'postal_code' => '33101',
    'country_code' => 'US'
];

$packageDetails = [
    'weight' => 3.2,
    'length' => 10,
    'width' => 8,
    'height' => 4,
    'description' => 'Electronics Package'
];

// Service codes: 01=Next Day Air, 02=2nd Day Air, 03=Ground
$serviceCode = '03'; // UPS Ground

try {
    $shipment = $ups->createShipment($fromAddress, $toAddress, $packageDetails, $serviceCode);
    
    echo "Tracking Number: {$shipment['tracking_number']}\n";
    echo "Label URL: {$shipment['label_url']}\n";
    echo "Total Cost: \${$shipment['total_charges']} {$shipment['currency']}\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

### 3. Track Shipment

```php
$trackingNumber = '1Z999AA1234567890';

try {
    $tracking = $ups->trackShipment($trackingNumber);
    
    echo "Status: {$tracking['status']}\n";
    echo "Service: {$tracking['service']}\n";
    
    if ($tracking['delivery_date']) {
        echo "Expected Delivery: {$tracking['delivery_date']}\n";
    }
    
    echo "\nActivity History:\n";
    foreach ($tracking['activities'] as $activity) {
        echo "- {$activity['timestamp']}: {$activity['status']} in {$activity['location']}\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

### 4. Schedule Pickup

```php
$pickupAddress = [
    'name' => 'ABC Company',
    'attention_name' => 'Shipping Department',
    'address_line' => '789 Business Blvd',
    'city' => 'Chicago',
    'state' => 'IL',
    'postal_code' => '60601',
    'country_code' => 'US',
    'phone' => '555-123-4567'
];

$packageDetails = [
    'weight' => 15.5,
    'length' => 20,
    'width' => 16,
    'height' => 12
];

$pickupDateTime = '2025-01-15 14:00:00';

try {
    $pickup = $ups->schedulePickup($pickupAddress, $packageDetails, $pickupDateTime);
    
    echo "Pickup Number: {$pickup['pickup_number']}\n";
    echo "Status: {$pickup['status']}\n";
    echo "Message: {$pickup['message']}\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

### 5. Test Authentication

```php
try {
    $token = $ups->getAccessToken();
    echo "Authentication successful! Token: " . substr($token, 0, 20) . "...\n";
} catch (Exception $e) {
    echo "Authentication failed: " . $e->getMessage();
}
```

## Address Format

All address parameters should follow this structure:

```php
$address = [
    'name' => 'Full Name',
    'attention_name' => 'Attention Name (optional, for shipper addresses)',
    'address_line' => 'Street Address',
    'city' => 'City',
    'state' => 'State/Province Code (e.g., NY, CA)',
    'postal_code' => 'ZIP/Postal Code',
    'country_code' => 'Country Code (e.g., US, CA)',
    'phone' => 'Phone Number (optional, for shipper addresses)'
];
```

## Package Details Format

Package information should include:

```php
$packageDetails = [
    'weight' => 5.5,        // Weight in pounds
    'length' => 12,          // Length in inches
    'width' => 8,            // Width in inches
    'height' => 6,           // Height in inches
    'description' => 'Package description (optional)'
];
```

## Service Codes

Common UPS service codes:

- `01` - UPS Next Day Air
- `02` - UPS 2nd Day Air
- `03` - UPS Ground
- `12` - UPS 3 Day Select
- `59` - UPS 2nd Day Air AM
- `65` - UPS Saver

## Error Handling

The service includes comprehensive error handling:

```php
try {
    $result = $ups->getRates($from, $to, $package);
} catch (Exception $e) {
    // Log the error
    Log::error('UPS API Error: ' . $e->getMessage());
    
    // Handle gracefully
    return response()->json([
        'error' => 'Shipping rate calculation failed',
        'details' => $e->getMessage()
    ], 500);
}
```

## Caching

Access tokens are automatically cached and refreshed:

- Tokens are cached for the duration of their validity minus 5 minutes
- Automatic refresh when expired
- Cache key: `ups_access_token`

## Environment Configuration

### Sandbox (Testing)
- Base URL: `https://wwwcie.ups.com`
- Use test credentials
- Set `UPS_PRODUCTION=false`

### Production
- Base URL: `https://onlinetools.ups.com`
- Use live credentials
- Set `UPS_PRODUCTION=true`

## Testing

Use the included `UPSServiceExample` class for testing:

```php
use App\Services\UPSServiceExample;

$example = new UPSServiceExample();

// Test authentication
$auth = $example->testAuthenticationExample();

// Test complete workflow
$workflow = $example->completeShippingWorkflowExample();
```

## Security Notes

- Never commit credentials to version control
- Use environment variables for sensitive data
- The service automatically truncates tokens in logs for security
- Consider using Laravel's encryption for storing credentials in database

## Troubleshooting

### Common Issues

1. **Authentication Failed**
   - Verify `UPS_CLIENT_ID` and `UPS_CLIENT_SECRET`
   - Check if credentials are valid for the environment (sandbox vs production)

2. **Invalid Address**
   - Ensure all required address fields are provided
   - Verify postal codes and state codes are valid

3. **Package Dimensions**
   - All dimensions must be positive numbers
   - Weight must be greater than 0

4. **Rate Limiting**
   - UPS may throttle requests in sandbox environment
   - Implement appropriate delays between requests in production

### Debug Mode

Enable detailed logging by checking Laravel logs:

```bash
tail -f storage/logs/laravel.log
```

## Support

For UPS API-specific issues, refer to the [UPS Developer Documentation](https://developer.ups.com/).

For service integration issues, check the Laravel logs and ensure all environment variables are properly configured.

## License

This service is part of your Laravel application and follows the same license terms.

