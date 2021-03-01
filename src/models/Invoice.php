<?php

namespace Serringer\Economic\Models;

use Serringer\Economic\Economic;

class Invoice
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
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public static function transform($api, $object)
    {
        $invoice = new self($api);

        $invoice->setCustomer($object->customer);
        $invoice->setCurrency($object->currency);
        $invoice->setDate($object->date);
        $invoice->setDueDate($object->dueDate);
        $invoice->setGrossAmount($object->grossAmount);
        $invoice->setLayout($object->layout);
        $invoice->setNetAmount($object->netAmount);
        $invoice->setNetAmountInBaseCurrency($object->netAmountInBaseCurrency);
        $invoice->setPaymentTerms($object->paymentTerms);
        $invoice->setPdf($object->pdf);
        $invoice->setRecipient($object->recipient);
        $invoice->setReferences($object->references ?? null);
        $invoice->setRemainder($object->remainder);
        $invoice->setRemainderInBaseCurrency($object->remainderInBaseCurrency);
        $invoice->setRoundingAmount($object->roundingAmount);
        $invoice->setSelf($object->self);
        $invoice->setVatAmount($object->vatAmount);
        $invoice->setBookedInvoiceNumber($object->bookedInvoiceNumber);

        return $invoice;
    }

    public function get($id)
    {
        return self::transform($this->api, $this->api->get('/invoices/booked/'.$id));
    }

    public function downloadPdf()
    {
        return $this->api->download('/invoices/booked/'.$this->getBookedInvoiceNumber().'/pdf');
    }

    public function getLayout(): Layout
    {
        return $this->layout;
    }

    public function getLayoutNumber()
    {
        if (isset($this->layout)) {
            return $this->layout->layoutNumber;
        }

        return null;
    }

    public function setLayout($layout)
    {
        $this->layout = [
            'layoutNumber' => $layout->layoutNumber,
            'layoutSelf' => $layout->self
        ];

        return $this;
    }

    public function getReferences(): References
    {
        return $this->references;
    }

    public function getReferencesSalesPerson()
    {
        if (isset($this->references)) {
            return $this->references->salesPerson;
        }

        return null;
    }

    public function getReferencesVendorReference()
    {
        if (isset($this->references)) {
            return $this->references->vendorReference;
        }

        return null;
    }

    public function getReferencesSalesPersonEmployeeNumber()
    {
        if (isset($this->references->salesPerson)) {
            return $this->references->salesPerson->employeeNumber;
        }

        return null;
    }

    public function getReferencesVendorReferenceEmployeeNumber()
    {
        if (isset($this->references->vendorReference)) {
            return $this->references->vendorReference->employeeNumber;
        }

        return null;
    }

    public function setReferences($references)
    {
        $this->references = [
            'salesPerson' => $references->salesPerson ?? null,
            'vendorReference' => $references->vendorReference ?? null
        ];

        return $this;
    }

    public function getRecipient()
    {
        return $this->recipient;
    }

    public function getRecipientName()
    {
        if (isset($this->recipient)) {
            return $this->recipient->name;
        }

        return null;
    }

    public function getRecipientVatZone()
    {
        if (isset($this->recipient)) {
            return $this->recipient->vatZone;
        }

        return null;
    }

    public function getRecipientVatZoneNumber()
    {
        if (isset($this->recipient->vatZone)) {
            return $this->recipient->vatZone->vatZoneNumber;
        }

        return null;
    }

    public function setRecipient($recipient)
    {
        $this->recipient = [
            'recipientName' => $recipient->name,
            'recipientVatZone' => $recipient->vatZone ?? null
        ];

        return $this;
    }

    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = [
            'paymentTermsNumber' => $paymentTerms->paymentTermsNumber,
            'paymentTermsSelf' => $paymentTerms->self
        ];

        return $this;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function getCustomerNumber()
    {
        if (isset($this->customer)) {
            return $this->customer->customerNumber;
        }

        return null;
    }

    public function setCustomer($customer)
    {
        $this->customer = [
            'costumerNumber' => $customer->customerNumber,
            'customerSelf' => $customer->self
        ];

        return $this;
    }

    public function getBookedInvoiceNumber()
    {
        return $this->bookedInvoiceNumber;
    }

    public function setBookedInvoiceNumber(int $bookedInvoiceNumber)
    {
        $this->bookedInvoiceNumber = $bookedInvoiceNumber;

        return $this;
    }

    public function getGrossAmount()
    {
        return $this->grossAmount;
    }

    public function setGrossAmount(float $grossAmount)
    {
        $this->grossAmount = $grossAmount;

        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency(string $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(string $date)
    {
        $this->date = $date;

        return $this;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate(string $dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getNetAmount()
    {
        return $this->netAmount;
    }

    public function setNetAmount(int $netAmount)
    {
        $this->netAmount = $netAmount;

        return $this;
    }

    public function getNetAmountInBaseCurrency()
    {
        return $this->netAmountInBaseCurrency;
    }

    public function setNetAmountInBaseCurrency(int $netAmountInBaseCurrency)
    {
        $this->netAmountInBaseCurrency = $netAmountInBaseCurrency;

        return $this;
    }

    public function getRemainder()
    {
        return $this->remainder;
    }

    public function setRemainder(int $remainder)
    {
        $this->remainder = $remainder;

        return $this;
    }

    public function getRemainderInBaseCurrency()
    {
        return $this->remainderInBaseCurrency;
    }

    public function setRemainderInBaseCurrency(int $remainderInBaseCurrency)
    {
        $this->remainderInBaseCurrency = $remainderInBaseCurrency;

        return $this;
    }

    public function getRoundingAmount()
    {
        return $this->roundingAmount;
    }

    public function setRoundingAmount(int $roundingAmount)
    {
        $this->roundingAmount = $roundingAmount;

        return $this;
    }

    public function getSelf()
    {
        return $this->self;
    }

    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }

    public function getVatAmount()
    {
        return $this->vatAmount;
    }

    public function setVatAmount(int $vatAmount)
    {
        $this->vatAmount = $vatAmount;

        return $this;
    }

    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }
}
