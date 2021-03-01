<?php


namespace Serringer\Economic\Models;


class Invoices
{
    private $currency;
    private $date;
    private $dueDate;
    private $netAmount;
    private $netAmountInBaseCurrency;
    private $remainder;
    private $remainderInBaseCurrency;
    private $roundingAmount;
    private $self;
    private $customer;
    private $paymentTerms;
    private $pdf;
    private $recipient;
    private $references;
    private $layout;
    private $grossAmount;
    private $bookedInvoiceNumber;
    private $vatAmount;

    /**
     * Invoices constructor.
     * @param $currency
     * @param $date
     * @param $dueDate
     * @param $netAmount
     * @param $netAmountInBaseCurrency
     * @param $remainder
     * @param $remainderInBaseCurrency
     * @param $roundingAmount
     * @param $customer
     * @param $paymentTerms
     * @param $recipient
     * @param $references
     * @param $layout
     * @param $grossAmount
     * @param $bookedInvoiceNumber
     * @param $vatAmount
     */
    public function __construct($data = [])
    {
        $this->currency = $data['currency'] ?? null;
        $this->date = $data['date'] ?? null;
        $this->dueDate = $data['dueDate'] ?? null;
        $this->netAmount = $data['netAmount'] ?? null;
        $this->netAmountInBaseCurrency = $data['netAmountInBaseCurrency'] ?? null;
        $this->remainder = $data['remainder'] ?? null;
        $this->remainderInBaseCurrency = $data['remainderInBaseCurrency'] ?? null;
        $this->roundingAmount = $data['roundingAmount'] ?? null;
        $this->customer = $data['customer'] ?? null;
        $this->paymentTerms = $data['paymentTerms'] ?? null;
        $this->recipient = $data['recipient'] ?? null;
        $this->references = $data['references'] ?? null;
        $this->layout = $data['layout'] ?? null;
        $this->grossAmount = $data['grossAmount'] ?? null;
        $this->bookedInvoiceNumber = $data['bookedInvoiceNumber'] ?? null;
        $this->vatAmount = $data['vatAmount'] ?? null;
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
     */
    public function setCurrency($currency): void
    {
        $this->currency = $currency;
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
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param  mixed  $dueDate
     */
    public function setDueDate($dueDate): void
    {
        $this->dueDate = $dueDate;
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
     */
    public function setNetAmount($netAmount): void
    {
        $this->netAmount = $netAmount;
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
     */
    public function setNetAmountInBaseCurrency($netAmountInBaseCurrency): void
    {
        $this->netAmountInBaseCurrency = $netAmountInBaseCurrency;
    }

    /**
     * @return mixed
     */
    public function getRemainder()
    {
        return $this->remainder;
    }

    /**
     * @param  mixed  $remainder
     */
    public function setRemainder($remainder): void
    {
        $this->remainder = $remainder;
    }

    /**
     * @return mixed
     */
    public function getRemainderInBaseCurrency()
    {
        return $this->remainderInBaseCurrency;
    }

    /**
     * @param  mixed  $remainderInBaseCurrency
     */
    public function setRemainderInBaseCurrency($remainderInBaseCurrency): void
    {
        $this->remainderInBaseCurrency = $remainderInBaseCurrency;
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
     */
    public function setRoundingAmount($roundingAmount): void
    {
        $this->roundingAmount = $roundingAmount;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param  mixed  $customer
     */
    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    /**
     * @param  mixed  $paymentTerms
     */
    public function setPaymentTerms($paymentTerms): void
    {
        $this->paymentTerms = $paymentTerms;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param  mixed  $recipient
     */
    public function setRecipient($recipient): void
    {
        $this->recipient = $recipient;
    }

    /**
     * @return mixed
     */
    public function getReferences()
    {
        return $this->references;
    }

    /**
     * @param  mixed  $references
     */
    public function setReferences($references): void
    {
        $this->references = $references;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param  mixed  $layout
     */
    public function setLayout($layout): void
    {
        $this->layout = $layout;
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
     */
    public function setGrossAmount($grossAmount): void
    {
        $this->grossAmount = $grossAmount;
    }

    /**
     * @return mixed
     */
    public function getBookedInvoiceNumber()
    {
        return $this->bookedInvoiceNumber;
    }

    /**
     * @param  mixed  $bookedInvoiceNumber
     */
    public function setBookedInvoiceNumber($bookedInvoiceNumber): void
    {
        $this->bookedInvoiceNumber = $bookedInvoiceNumber;
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
     */
    public function setVatAmount($vatAmount): void
    {
        $this->vatAmount = $vatAmount;
    }


}
