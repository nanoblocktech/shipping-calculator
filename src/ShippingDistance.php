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

class ShippingDistance
{
    /**
     * The distance between points.
     * @var float $distance
    */
    private float $distance = 0;

    /**
     * The measurement unit for distance (e.g., 'km', 'ml').
     * @var string $radius
    */
    private string $radius = 'km';

    /**
     * The initial shipping amount.
     * @var float $amount
    */
    private float $amount = 0;

    /**
     * ShippingDistance constructor.
     *
     * @param float $distance The distance between points.
     * @param string $radius The measurement unit for distance (e.g., 'km', 'ml').
     * @param float $amount The initial shipping amount.
     */
    public function __construct(float $distance, string $radius, float $amount)
    {
        $this->distance = $distance;
        $this->radius = $radius;
        $this->amount = $amount;
    }

    /**
     * Get the distance between points.
     *
     * @return float The distance.
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * Get the distance as a string (e.g., '10km').
     *
     * @return string The formatted distance string.
     */
    public function getString(): string
    {
        return $this->distance . $this->radius;
    }

    /**
     * Convert the distance to currency format with optional symbol and decimal places.
     *
     * @param int $decimal The number of decimal places.
     * @param string|null $symbol The currency symbol.
     * 
     * @return string The formatted currency string.
     */
    public function toCurrency(int $decimal = 2, string $symbol = null): string
    {
        return $symbol === null ?:$symbol . $this->getCurrency($decimal);
    }

    /**
     * Convert the distance from kilometer to miles.
     *
     * @return float The distance in miles.
     */
    public function toMile(): float
    {
        return ($this->radius === 'km') ? $this->distance * 0.621371 : $this->distance;
    }

    /**
     * Convert the distance from miles to kilometers.
     *
     * @return float The distance in kilometers.
     */
    public function toKilometer(): float
    {
        return ($this->radius === 'ml') ? $this->distance * 1.60934 : $this->distance;
    }

    /**
     * Get the calculated charges
     *
     * @return float 
     */
    public function getCharges(): float
    {
        return $this->amount * $this->distance;
    }

    /**
     * Get the currency value based on the distance and initial amount.
     *
     * @param int $decimal The number of decimal places.
     * @return string The formatted currency value.
     */
    public function getCurrency(int $decimal = 2): string
    {
        return number_format($this->amount * $this->distance, $decimal, '.', ',');
    }
}
