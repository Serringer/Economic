<?php


namespace Serringer\Economic\Entities;

class Line
{
    public $description;
    public $quantity;
    public $discountPercentage;
    public $unitNetPrice;
    public $product;

    public function __construct(
        string $productNumber,
        string $name,
        int $quantity,
        float $price,
        float $discountPercentage = null
    ) {
        $this->unitNetPrice = $price;
        $this->discountPercentage = $discountPercentage;
        $this->quantity = $quantity;
        $this->description = $name;
        $this->product = ["productNumber" => $productNumber];
    }
}
