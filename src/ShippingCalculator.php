<?php 
/**
 * Luminova Framework
 *
 * @package Luminova
 * @author Ujah Chigozie Peter
 * @copyright (c) Nanoblock Technology Ltd
 * @license See LICENSE file
*/
namespace Luminova\ExtraUtils;

use Luminova\ExtraUtils\ShippingDistance;

class ShippingCalculator {
    /**
     * Calculate in kilometers from
     * @var string KM
    */
    public const KM = 'km';

    /**
     * Calculate in miles
     * @var string ML
    */
    public const ML = 'ml';
    /**
     * Origin point 
     * @var array $origin
    */
    private array $origin = [];

    /**
     * Destination point 
     * @var array $destination
    */
    private array $destination = [];

    /**
     * distance between points
     * @var float $distance
    */
    private float $distance = 0;

    /**
     * Measurement between points
     * @var float $radius
    */
    private string $radius = 'km';

    /**
     * Initial shipping amount
     * @var float $amount
    */
    private float $amount = 0;

    /**
     * Set the origin location.
     *
     * @param float $lat Latitude of the origin.
     * @param float $lng Longitude of the origin.
     * 
     * @return ShippingCalculator $this
     */
    public function setOrigin(float $lat, float $lng): self 
    {
        $this->origin = ['lat' => $lat, 'lng' => $lng];
        return $this;
    }

    /**
     * Set the destination location.
     *
     * @param float $lat Latitude of the destination.
     * @param float $lng Longitude of the destination.
     * 
     * @return ShippingCalculator $this
     */
    public function setDestination(float $lat, float $lng): self 
    {
        $this->destination = ['lat' => $lat, 'lng' => $lng];
        return $this;
    }

    /**
     * Set initial shipping charge per distance.
     *
     * @param float $amount Charge amount per kilometer.
     *
     * @return ShippingCalculator $this
     */
    public function setCharge(float $amount): self 
    {
      $this->amount = $amount;
      return $this;
    }

    /**
     * Calculate the distance between origin and destination.
     *
     * @param string $type Distance type ('km' for kilometers, 'ml' for miles).
     *
     * @return ShippingDistance New distance class instance
     */
    public function calculate(string $type = self::KM): ShippingDistance 
    {
        $this->radius = $type;
        $earthRadius = $type === self::ML ? 3959 : 6371;

        $originLat = deg2rad($this->origin['lat']);
        $originLng = deg2rad($this->origin['lng']);
        $destinationLat = deg2rad($this->destination['lat']);
        $destinationLng = deg2rad($this->destination['lng']);

        $distanceLat = $destinationLat - $originLat;
        $distanceLng = $destinationLng - $originLng;

        $pointX = sin($distanceLat / 2) * sin($distanceLat / 2) + cos($originLat) * cos($destinationLat) * sin($distanceLng / 2) * sin($distanceLng / 2);
        $pointY = 2 * atan2(sqrt($pointX), sqrt(1 - $pointX));

        $this->distance = $earthRadius * $pointY;

        return new ShippingDistance($this->distance, $this->radius, $this->amount);
    }
}
