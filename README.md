## Class Shipping Calculator

Determines the shipping fee based on the customer's longitude and latitude to the business location.

### Functions

- Calculates the distance between business and customer locations
- Determines the shipping fee based on the provided charge per distance.

Installation Guide via Composer:

```bash
composer require nanoblocktech/shipping-calculator
```

### Usages 

```php
use Luminova\ExtraUtils\ShippingCalculator;

$calculator = new ShippingCalculator();

// Set business and customer locations

$calculator->setOrigin(6.47427, 7.56196); // Business location (Enugu Airport Nigeria)
$calculator->setDestination(6.51181, 7.35535); // Customer location (Udi Nigeria)
$calculator->setCharge(100); // Initial shipping cost per distance km, or ml

// Calculate distance and return new ShippingDistance instance class

$calculate = $calculator->calculate(ShippingCalculator::KM);

// Get your calculated information

echo "Distance: $calculate->getDistance() \n";
echo "Distance[km|ml]: $calculate->getString() \n";
echo "Shipping Fee: $calculate->getCurrency(2)\n";
echo "Shipping Fee: $calculate->getCharges()\n";
```

### Methods 

#### ShippingCalculator

Methods And Param                                       |  Descriptions 
--------------------------------------------------------|-----------------------------------------------------
setOrigin(float latitude, float longitude): self        | Set the origin location latitude and longitude
setDestination(float latitude, float longitude): self   | Set the destination location latitude and longitude
setCharge(float amount): self                           | Set initial shipping charge per calculation distance
calculate(float amount): ShippingDistance               | Calculate the distance between origin and destination.

#### ShippingDistance

The method which `calculate` is returned 

Methods And Param                                       |  Descriptions 
--------------------------------------------------------|-----------------------------------------------------------------------------------------
getDistance(): float                                    | Get the calculated distance between the origin and destination latitude and longitude.
getString(): string                                     | Get the distance as a string (e.g., '10km').
toCurrency(int decimal = 2, string symbol): string      | Convert the distance to currency format with optional currency symbol and decimal places.
toMile(): float                                         | Convert the distance from kilometer to miles.
toKilometer(): float                                    | Convert the distance from miles to kilometers.
getCurrency(int decimal = 2): string                    | Get the calculated currency value based on the distance and initial amount.
getCharges(): float                                     | Get the calculated charges
