<?php


namespace Serringer\Economic\Entities;


class Line
{
    private $lineNumber;
    private $sortKey;
    private $unit;
    private $unitNumber;
    private $name;
    private $product = [];
    private $quantity;
    private $unitNetPrice;
    private $discountPercentage;
    private $unitCostPrice;
    private $totalNetAmount;
    private $marginInBaseCurrency;
    private $marginPercentage;

    public function __construct($data)
    {
        $this->setLineNumber($data["LineNumber"] ?? null);
        $this->setSortKey($data["SortKey"] ?? null);
        $this->setUnit($data["Unit"] ?? null);
        $this->setUnitNumber($data["UnitNumber"] ?? null);
        $this->setName($data["Name"] ?? null);
        $this->setProduct($data["Product"] ?? []);
        $this->setQuantity($data["Quantity"] ?? null);
        $this->setUnitNetPrice($data["UnitNetPrice"] ?? null);
        $this->setDiscountPercentage($data["DiscountPercentage"] ?? null);
        $this->setUnitCostPrice($data["UnitCostPrice"] ?? null);
        $this->setTotalNetAmount($data["TotalNetAmount"] ?? null);
        $this->setMarginInBaseCurrency($data["MarginInBaseCurrency"] ?? null);
        $this->setMarginPercentage($data["MarginPercentage"] ?? null);
    }

    /**
     * @return mixed
     */
    public function getLineNumber()
    {
        return $this->lineNumber;
    }

    /**
     * @param  mixed  $lineNumber
     * @return Line
     */
    public function setLineNumber($lineNumber)
    {
        $this->lineNumber = $lineNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSortKey()
    {
        return $this->sortKey;
    }

    /**
     * @param  mixed  $sortKey
     * @return Line
     */
    public function setSortKey($sortKey)
    {
        $this->sortKey = $sortKey;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param  mixed  $unit
     * @return Line
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnitNumber()
    {
        return $this->unitNumber;
    }

    /**
     * @param  mixed  $unitNumber
     * @return Line
     */
    public function setUnitNumber($unitNumber)
    {
        $this->unitNumber = $unitNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  mixed  $name
     * @return Line
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getProduct(): array
    {
        return $this->product;
    }

    /**
     * @param  array  $product
     * @return Line
     */
    public function setProduct(array $product): Line
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param  mixed  $quantity
     * @return Line
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnitNetPrice()
    {
        return $this->unitNetPrice;
    }

    /**
     * @param  mixed  $unitNetPrice
     * @return Line
     */
    public function setUnitNetPrice($unitNetPrice)
    {
        $this->unitNetPrice = $unitNetPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    /**
     * @param  mixed  $discountPercentage
     * @return Line
     */
    public function setDiscountPercentage($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnitCostPrice()
    {
        return $this->unitCostPrice;
    }

    /**
     * @param  mixed  $unitCostPrice
     * @return Line
     */
    public function setUnitCostPrice($unitCostPrice)
    {
        $this->unitCostPrice = $unitCostPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalNetAmount()
    {
        return $this->totalNetAmount;
    }

    /**
     * @param  mixed  $totalNetAmount
     * @return Line
     */
    public function setTotalNetAmount($totalNetAmount)
    {
        $this->totalNetAmount = $totalNetAmount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMarginInBaseCurrency()
    {
        return $this->marginInBaseCurrency;
    }

    /**
     * @param  mixed  $marginInBaseCurrency
     * @return Line
     */
    public function setMarginInBaseCurrency($marginInBaseCurrency)
    {
        $this->marginInBaseCurrency = $marginInBaseCurrency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMarginPercentage()
    {
        return $this->marginPercentage;
    }

    /**
     * @param  mixed  $marginPercentage
     * @return Line
     */
    public function setMarginPercentage($marginPercentage)
    {
        $this->marginPercentage = $marginPercentage;
        return $this;
    }
}
