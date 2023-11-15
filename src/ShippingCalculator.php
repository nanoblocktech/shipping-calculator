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
     * Set the origin location.
     *
     * @param float $lat Latitude of the origin.
     * @param float $lng Longitude of the origin.
     */
    public function setOrigin(float $lat, float $lng): void 
    {
        $this->origin = ['lat' => $lat, 'lng' => $lng];
    }

    /**
     * Set the destination location.
     *
     * @param float $lat Latitude of the destination.
     * @param float $lng Longitude of the destination.
     */
    public function setDestination(float $lat, float $lng): void 
    {
        $this->destination = ['lat' => $lat, 'lng' => $lng];
    }

    /**
     * Get the distance between origin and destination.
     * 
     * @return string The calculated distance.
     */
    public function getDistance(): string 
    {
        return $this->distance . $this->radius;
    }

    /**
     * Calculate the shipping fee based on the charge per kilometer.
     *
     * @param float $amount Charge amount per kilometer.
     *
     * @return float The calculated shipping fee.
     */
    public function getCharge(float $amount): float 
    {
        return $amount * $this->distance;
    }

    /**
     * Calculate the distance between origin and destination.
     *
     * @param string $type Distance type ('km' for kilometers, 'ml' for miles).
     *
     * @return float The calculated distance.
     */
    public function calculate(string $type = self::KM): float 
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

        return $this->distance;
    }
}
