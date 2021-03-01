<?php

namespace Serringer\Economic\Models;

use Serringer\Economic\Economic;

class Product
{
    private $barCode;
    private $barred;
    private $costPrice;
    private $salesPrice;
    private $recommendedPrice;
    private $description;
    private $lastUpdated;
    private $name;
    private $productGroup;
    private $invoices;
    private $productNumber;
    private $unit;
    private $self;
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public static function transform($api, $object)
    {
        $product = new self($api);

        $product->setBarCode($object->barCode ?? null)
            ->setBarred($object->barred)
            ->setCostPrice($object->costPrice ?? null)
            ->setSalesPrice($object->salesPrice ?? null)
            ->setRecommendedPrice($object->recommendedPrice ?? null)
            ->setDescription($object->description ?? null)
            ->setLastUpdated($object->lastUpdated)
            ->setName($object->name)
            ->setProductGroup($object->productGroup)
            ->setProductNumber($object->productNumber)
            ->setUnit($object->unit ?? null)
            ->setDepartmentalDistribution($object->departmentalDistribution ?? null)
            ->setInventory($object->inventory ?? null)
            ->setSelf($object->self)
            ->setInventory($object->inventory ?? null)
            ->setInvoices($object->invoices ?? null);

        return $product;
    }

    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->api->collection('/products?'.$filter->filter().'&', $this);
        } else {
            return $this->api->collection('/products?', $this);
        }
    }

    public function get($id)
    {
        return self::transform($this->api, $this->api->get('/products/'.$id));
    }

    public function getDepartmentalDistribution(): ?DepartmentalDistribution
    {
        return $this->departmentalDistribution;
    }

    public function setDepartmentalDistribution($departmentalDistribution = null)
    {
        if (isset($departmentalDistribution)) {
            $this->departmentalDistribution = new DepartmentalDistribution($departmentalDistribution->departmentalDistributionNumber,
                $departmentalDistribution->distributionType, $departmentalDistribution->self);
        }

        return $this;
    }

    public function getDepartmentalDistributionNumber(): ?int
    {
        if (isset($this->departmentalDistribution)) {
            return $this->departmentalDistribution->departmentalDistributionNumber;
        }

        return null;
    }

    public function setDepartmentalDistributionNumber(int $departmentalDistributionNumber)
    {
        if (isset($this->departmentalDistribution)) {
            $this->departmentalDistribution->departmentalDistributionNumber = $departmentalDistributionNumber;
        } else {
            $this->departmentalDistribution = $this->api->setClass('DepartmentalDistribution',
                'departmentalDistributionNumber');
            $this->departmentalDistribution->departmentalDistributionNumber = $departmentalDistributionNumber;
        }

        return $this;
    }

    public function getDepartmentalDistributionType(): ?string
    {
        if (isset($this->departmentalDistribution)) {
            return $this->departmentalDistribution->distributionType;
        }

        return null;
    }

    public function setDepartmentalDistributionType(string $distributionType)
    {
        if (isset($this->departmentalDistribution)) {
            $this->departmentalDistribution->distributionType = $distributionType;
        } else {
            $this->departmentalDistribution = $this->api->setClass('DepartmentalDistribution', 'distributionType');
            $this->departmentalDistribution->distributionType = $distributionType;
        }

        return $this;
    }

    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    public function setInventory($inventory = null)
    {
        if (isset($inventory)) {
            $this->inventory = new Inventory($inventory->available, $inventory->grossWeight, $inventory->inStock,
                $inventory->netWeight, $inventory->orderedByCustomers, $inventory->orderedFromSuppliers,
                $inventory->packageVolume, $inventory->recommendedPrice);
        }

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit($unit = null)
    {
        if (isset($unit)) {
            $this->unit = new Unit($unit->unitNumber, $unit->name, $unit->self);
        }

        return $this;
    }

    public function getUnitName(): ?string
    {
        if (isset($this->unit)) {
            return $this->unit->name;
        }

        return null;
    }

    public function setUnitName(string $name)
    {
        if (isset($this->unit)) {
            $this->unit->name = $name;
        } else {
            $this->unit = $this->api->setClass('Unit', 'name');
            $this->unit->name = $name;
        }

        return $this;
    }

    public function getUnitNumber(): ?int
    {
        if (isset($this->unit)) {
            return $this->unit->unitNumber;
        }

        return null;
    }

    public function setUnitNumber(int $unitNumber)
    {
        if (isset($this->unit)) {
            $this->unit->unitNumber = $unitNumber;
        } else {
            $this->unit = $this->api->setClass('Unit', 'unitNumber');
            $this->unit->unitNumber = $unitNumber;
        }

        return $this;
    }

    public function getBarCode(): ?string
    {
        return $this->barCode;
    }

    public function setBarCode(?string $barCode)
    {
        $this->barCode = $barCode;

        return $this;
    }

    public function getBarred(): ?bool
    {
        return $this->barred;
    }

    public function setBarred(bool $barred)
    {
        $this->barred = $barred;

        return $this;
    }

    public function getCostPrice(): ?float
    {
        return $this->costPrice;
    }

    public function setCostPrice(?float $costPrice)
    {
        $this->costPrice = $costPrice;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function getLastUpdated(): ?string
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(string $lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getProductGroup(): ?ProductGroup
    {
        return $this->productGroup;
    }

    public function setProductGroup($productGroup = null)
    {
        if (isset($productGroup)) {
            $this->productGroup = [
                "productGroupNumber" => $productGroup->productGroupNumber,
                "name" => $productGroup->name,
                "products" => $productGroup->products,
                "salesAccounts" => $productGroup->salesAccounts,
                "self" => $productGroup->self
            ];
        }

        return $this;
    }

    public function getProductGroupNumber(): ?int
    {
        if (isset($this->productGroup)) {
            return $this->productGroup->productGroupNumber;
        }

        return null;
    }

    public function setProductGroupNumber(int $productGroupNumber)
    {
        if (isset($this->productGroup)) {
            $this->productGroup->productGroupNumber = $productGroupNumber;
        } else {
            $this->productGroup = $this->api->setClass('ProductGroup', 'productGroupNumber');
            $this->productGroup->productGroupNumber = $productGroupNumber;
        }

        return $this;
    }

    public function getProductGroupName(): ?string
    {
        if (isset($this->productGroup)) {
            return $this->productGroup->name;
        }

        return null;
    }

    public function setProductGroupName(string $name)
    {
        if (isset($this->productGroup)) {
            $this->productGroup->name = $name;
        } else {
            $this->productGroup = $this->api->setClass('ProductGroup', 'name');
            $this->productGroup->name = $name;
        }

        return $this;
    }

    public function getProductNumber(): ?string
    {
        return $this->productNumber;
    }

    public function setProductNumber(string $productNumber)
    {
        $this->productNumber = $productNumber;

        return $this;
    }

    public function getSalesPrice(): ?float
    {
        return $this->salesPrice;
    }

    public function setSalesPrice(?float $salesPrice)
    {
        $this->salesPrice = $salesPrice;

        return $this;
    }

    public function getRecommendedPrice(): ?float
    {
        return $this->recommendedPrice;
    }

    public function setRecommendedPrice(?float $recommendedPrice)
    {
        $this->recommendedPrice = $recommendedPrice;

        return $this;
    }

    public function getSelf(): ?string
    {
        return $this->self;
    }

    public function setSelf(?string $self)
    {
        $this->self = $self;

        return $this;
    }

    public function getInvoices()
    {
        return $this->invoices;
    }

    public function setInvoices($invoices)
    {
        $this->invoices = $invoices;
        return $this;
    }
}
