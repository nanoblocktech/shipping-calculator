## Class Shipping Calculator

Determines the shipping fee based on the customer's longitude and latitude to the business location.

### Functions

- Calculates the distance between business and customer locations
- Determines the shipping fee based on the provided charge per distance.

Installation Guide via Composer:

```md
composer require nanoblocktech/shipping-calculator
```

### Usages 

```php
$calculator = new ShippingCalculator();

// Set business and customer locations
$calculator->setOrigin(6.47427, 7.56196); // Business location (Enugu Airport Nigeria)
$calculator->setDestination(6.51181, 7.35535); // Customer location (Udi Nigeria)

// Get the distance in kilometers
$distance = $calculator->calculate(ShippingCalculator::KM);

// Calculate the shipping fee based on a charge of $0.1 per distance
$chargeAmount = 0.1;
$shippingFee = $calculator->getCharge($chargeAmount);

echo "Distance: $distance \n";
echo "Distance Kilometer: $calculator->getDistance() \n";
echo "Shipping Fee: $shippingFee\n";
```
