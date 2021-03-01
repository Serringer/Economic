<?php


namespace Serringer\Economic\Entities;


class Invoice
{
    private $date;
    private $currency;
    private $exchangeRate;
    private $netAmount;
    private $netAmountInBaseCurrency;
    private $grossAmount;
    private $marginInBaseCurrency;
    private $marginPercentage;
    private $vatAmount;
    private $roundingAmount;
    private $costPriceInBaseCurrency;
    private $paymentTerms = [];
    private $customer = [];
    private $recipient = [];
    private $delivery = [];
    private $references = [
        "other" => ""
    ];
    private $layout = [
        "layoutNumber" => null
    ];
    private $lines = [];

    /**
     * Invoice constructor.
     */
    public function __construct($data)
    {
        $this->setDate($data['Date'] ?? null);
        $this->setCurrency($data['Currency'] ?? null);
        $this->setExchangeRate($data['ExchangeRate'] ?? null);
        $this->setNetAmount($data['NetAmount'] ?? null);
        $this->setNetAmountInBaseCurrency($data['NetAmountInBaseCurrency'] ?? null);
        $this->setGrossAmount($data['GrossAmount'] ?? null);
        $this->setMarginInBaseCurrency($data['MarginInBaseCurrency'] ?? null);
        $this->setMarginPercentage($data['MarginPercentage'] ?? null);
        $this->setVatAmount($data['VatAmount'] ?? null);
        $this->setRoundingAmount($data['RoundingAmount'] ?? null);
        $this->setCostPriceInBaseCurrency($data['CostPriceInBaseCurrency'] ?? null);
        $this->setPaymentTerms($data['PaymentTerms'] ?? null);
        $this->setCustomer($data['Customer'] ?? null);
        $this->setRecipient($data['Recipient'] ?? null);
        $this->setDelivery($data['Delivery'] ?? null);
        $this->setReferences($data['References'] ?? null);
        $this->setLayout($data['Layout'] ?? null);
        $this->setLines($data['Lines'] ?? null);
    }


    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param  mixed  $date
     * @return Invoice
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param  mixed  $currency
     * @return Invoice
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * @param  mixed  $exchangeRate
     * @return Invoice
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNetAmount()
    {
        return $this->netAmount;
    }

    /**
     * @param  mixed  $netAmount
     * @return Invoice
     */
    public function setNetAmount($netAmount)
    {
        $this->netAmount = $netAmount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNetAmountInBaseCurrency()
    {
        return $this->netAmountInBaseCurrency;
    }

    /**
     * @param  mixed  $netAmountInBaseCurrency
     * @return Invoice
     */
    public function setNetAmountInBaseCurrency($netAmountInBaseCurrency)
    {
        $this->netAmountInBaseCurrency = $netAmountInBaseCurrency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGrossAmount()
    {
        return $this->grossAmount;
    }

    /**
     * @param  mixed  $grossAmount
     * @return Invoice
     */
    public function setGrossAmount($grossAmount)
    {
        $this->grossAmount = $grossAmount;
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
     * @return Invoice
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
     * @return Invoice
     */
    public function setMarginPercentage($marginPercentage)
    {
        $this->marginPercentage = $marginPercentage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVatAmount()
    {
        return $this->vatAmount;
    }

    /**
     * @param  mixed  $vatAmount
     * @return Invoice
     */
    public function setVatAmount($vatAmount)
    {
        $this->vatAmount = $vatAmount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoundingAmount()
    {
        return $this->roundingAmount;
    }

    /**
     * @param  mixed  $roundingAmount
     * @return Invoice
     */
    public function setRoundingAmount($roundingAmount)
    {
        $this->roundingAmount = $roundingAmount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCostPriceInBaseCurrency()
    {
        return $this->costPriceInBaseCurrency;
    }

    /**
     * @param  mixed  $costPriceInBaseCurrency
     * @return Invoice
     */
    public function setCostPriceInBaseCurrency($costPriceInBaseCurrency)
    {
        $this->costPriceInBaseCurrency = $costPriceInBaseCurrency;
        return $this;
    }

    /**
     * @return array
     */
    public function getPaymentTerms(): array
    {
        return $this->paymentTerms;
    }

    /**
     * @param  array  $paymentTerms
     * @return Invoice
     */
    public function setPaymentTerms(?array $paymentTerms): Invoice
    {
        $paymentTermsArray = $paymentTerms ??
            [
                "paymentTermsNumber" => 1,
                "daysOfCredit" => 14,
                "name" => "Lobende maned 14 dage",
                "paymentTermsType" => "invoiceMonth"
            ];
        $this->paymentTerms = $paymentTermsArray;
        return $this;
    }

    /**
     * @return null[]
     */
    public function getCustomer(): array
    {
        return $this->customer;
    }

    /**
     * @param  null[]  $customer
     * @return Invoice
     */
    public function setCustomer(?array $customer): Invoice
    {
        $customerArray = $customer ?? [
                "customerNumber" => null
            ];
        $this->customer = $customerArray;
        return $this;
    }

    /**
     * @return array
     */
    public function getRecipient(): array
    {
        return $this->recipient;
    }

    /**
     * @param  array  $recipient
     * @return Invoice
     */
    public function setRecipient(array $recipient): Invoice
    {
        $recipientArray = [
            "name" => "",
            "address" => "",
            "zip" => "",
            "city" => "",
            "vatZone" => [
                "name" => "",
                "vatZoneNumber" => null,
                "enabledForCustomer" => true,
                "enabledForSupplier" => true
            ],
        ];

        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getDelivery(): array
    {
        return $this->delivery;
    }

    /**
     * @param  string[]  $delivery
     * @return Invoice
     */
    public function setDelivery(array $delivery): Invoice
    {
        $deliveryArray = [
            "address" => "",
            "zip" => "",
            "city" => "",
            "country" => "",
            "deliveryDate" => ""
        ];
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getReferences(): array
    {
        return $this->references;
    }

    /**
     * @param  string[]  $references
     * @return Invoice
     */
    public function setReferences(array $references): Invoice
    {
        $refferenceArray = [
            "other" => ""
        ];
        $this->references = $references;
        return $this;
    }

    /**
     * @return null[]
     */
    public function getLayout(): array
    {
        return $this->layout;
    }

    /**
     * @param  null[]  $layout
     * @return Invoice
     */
    public function setLayout(array $layout): Invoice
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * @return array
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * @param  array  $lines
     * @return Invoice
     */
    public function setLines(array $lines): Invoice
    {
        $this->lines = $lines;
        return $this;
    }
}
