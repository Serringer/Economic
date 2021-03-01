<?php


namespace Serringer\Economic\Models;

use Serringer\Economic\Economic;

class Customer
{
    private $customerNumber;
    private $currency;
    private $paymentTerms;
    private $customerGroup;
    private $address;
    private $balance;
    private $dueAmount;
    private $city;
    private $customerContact;
    private $country;
    private $email;
    private $name;
    private $zip;
    private $telephoneAndFaxNumber;
    private $invoices;
    private $website;
    private $vatZone;
    private $lastUpdated;
    private $defaultDeliveryLocation;
    private $deliveryLocations;
    private $barred;
    private $corporateIdentificationNumber;
    private $creditLimit;
    private $ean;
    private $totals;
    private $publicEntryNumber;
    private $vatNumber;
    private $salesPerson;
    private $contacts;
    private $self;

    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public static function transform($api, $object): self
    {
        $customer = new self($api);

        $customer->setCustomerNumber($object->customerNumber);
        $customer->setCurrency($object->currency);
        $customer->setPaymentTerms($object->paymentTerms);
        $customer->setCustomerGroup($object->customerGroup);
        $customer->setAddress($object->address ?? null);
        $customer->setBalance($object->balance);
        $customer->setDueAmount($object->dueAmount);
        $customer->setCity($object->city ?? null);
        $customer->setCountry($object->country ?? null);
        $customer->setEmail($object->email ?? null);
        $customer->setName($object->name);
        $customer->setZip($object->zip ?? null);
        $customer->setTelephoneAndFaxNumber($object->telephoneAndFaxNumber ?? null);
        $customer->setWebsite($object->website ?? null);
        $customer->setVatZone($object->vatZone);
        $customer->setLastUpdated($object->lastUpdated);
        $customer->setBarred($object->barred ?? null);
        $customer->setCorporateIdentificationNumber($object->corporateIdentificationNumber ?? null);
        $customer->setCreditLimit($object->creditLimit ?? null);
        $customer->setEan($object->ean ?? null);
        $customer->setPublicEntryNumber($object->publicEntryNumber ?? null);
        $customer->setSalesPerson($object->salesPerson ?? null);
        $customer->setContacts($object->contacts);
        $customer->setInvoices($object->invoices);
        $customer->setDefaultDeliveryLocation($object->defaultDeliveryLocation ?? null);
        $customer->setDeliveryLocations($object->deliveryLocations);
        $customer->setTotals($object->totals);
        $customer->setVatNumber($object->vatNumber ?? null);
        $customer->setSelf($object->self);

        return $customer;
    }

    public function get($id)
    {
        return self::transform($this->api, $this->api->get('/customers/'.$id));
    }

    public function draftInvoices()
    {
        return $this->api->collection(
            '/customers/'.$this->getCustomerNumber().'/invoices/drafts?',
            new DraftInvoice($this->api)
        );
    }

    public function bookedInvoices()
    {
        return $this->api->collection(
            '/customers/'.$this->getCustomerNumber().'/invoices/booked?',
            new Invoice($this->api)
        );
    }

    public function getCustomerContact(): ?CustomerContact
    {
        return $this->customerContact;
    }

    public function setCustomerContact($customerContact = null)
    {
        if (isset($customerContact)) {
            $this->customerContact = [
                'ContactNumber' => $customerContact->customerContactNumber,
                'customerContact' => $customerContact->self,
            ];
        }

        return $this;
    }

    public function getCustomerContactNumber()
    {
        if (isset($this->customerContact)) {
            return $this->customerContact->customerContactNumber;
        }

        return null;
    }

    public function setCustomerContactNumber(int $customerContactNumber)
    {
        return $this;
    }

    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    public function setVatNumber(?string $vatNumber)
    {
        $this->vatNumber = $vatNumber;

        return $this;
    }

    public function getTotals()
    {
        return $this->totals;
    }

    public function setTotals($totals)
    {
        return [
            'totals' => [
                'booked' => $totals->booked, 'drafts' => $totals->drafts,
            ],
            'totals_self' => $totals->self,
        ];
    }

    public function getInvoices()
    {
        return $this->invoices;
    }

    public function setInvoices($invoices)
    {
        $this->invoices = new Invoices($invoices->booked, $invoices->drafts);

        return $this;
    }

    public function getDefaultDeliveryLocation()
    {
        return $this->defaultDeliveryLocation;
    }

    public function setDefaultDeliveryLocation($defaultDeliveryLocation = null)
    {
        if (isset($defaultDeliveryLocation)) {
            $this->defaultDeliveryLocation = new DefaultDeliveryLocation(
                $defaultDeliveryLocation->deliveryLocationNumber,
                $defaultDeliveryLocation->self
            );
        }

        return $this;
    }

    public function getCustomerNumber()
    {
        return $this->customerNumber;
    }

    public function setCustomerNumber(int $customerNumber)
    {
        $this->customerNumber = $customerNumber;

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

    public function getContacts()
    {
        return $this->contacts;
    }

    public function setContacts(string $contacts)
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = [
            'paymentTermNumber' => $paymentTerms->paymentTermsNumber,
            'paymentTermSelf' => $paymentTerms->self,
        ];

        return $this;
    }

    public function getPaymentTermsNumber()
    {
        if (isset($this->paymentTerms)) {
            return $this->paymentTerms->paymentTermsNumber;
        }

        return null;
    }

    public function setPaymentTermsNumber(int $paymentTermsNumber)
    {
        if (isset($this->paymentTerms)) {
            $this->paymentTerms->paymentTermsNumber = $paymentTermsNumber;
        } else {
            $this->paymentTerms = $this->api->setClass('PaymentTerms', 'paymentTermsNumber');
            $this->paymentTerms->paymentTermsNumber = $paymentTermsNumber;
        }

        return $this;
    }

    public function getCustomerGroup()
    {
        return $this->customerGroup;
    }

    public function setCustomerGroup($customerGroup)
    {
        $this->customerGroup = [
            'customerGroupNumber' => $customerGroup->customerGroupNumber,
            'customerGroupSelf' => $customerGroup->self,
        ];

        return $this;
    }

    public function getCustomerGroupNumber()
    {
        if (isset($this->customerGroup)) {
            return $this->customerGroup->customerGroupNumber;
        }

        return null;
    }

    public function setCustomerGroupNumber(int $customerGroupNumber)
    {
        if (isset($this->customerGroup)) {
            $this->customerGroup->customerGroupNumber = $customerGroupNumber;
        } else {
            $this->customerGroup = $this->api->setClass('CustomerGroup', 'customerGroupNumber');
            $this->customerGroup->customerGroupNumber = $customerGroupNumber;
        }

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(?string $address)
    {
        $this->address = $address;

        return $this;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setBalance(float $balance)
    {
        $this->balance = $balance;

        return $this;
    }

    public function getDueAmount()
    {
        return $this->dueAmount;
    }

    public function setDueAmount(float $dueAmount)
    {
        $this->dueAmount = $dueAmount;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(?string $city)
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry(?string $country)
    {
        $this->country = $country;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(?string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(?string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function setZip(?string $zip)
    {
        $this->zip = $zip;

        return $this;
    }

    public function getTelephoneAndFaxNumber()
    {
        return $this->telephoneAndFaxNumber;
    }

    public function setTelephoneAndFaxNumber(?string $telephoneAndFaxNumber)
    {
        $this->telephoneAndFaxNumber = $telephoneAndFaxNumber;

        return $this;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite(?string $website)
    {
        $this->website = $website;

        return $this;
    }

    public function getVatZone()
    {
        return $this->vatZone;
    }

    public function setVatZone($vatZone)
    {
        $this->vatZone = [
            'vatZoneNumber' => $vatZone->vatZoneNumber,
            'vatZoneSelf' => $vatZone->self,
        ];

        return $this;
    }

    public function getVatZoneNumber()
    {
        if (isset($this->vatZone)) {
            return $this->vatZone->vatZoneNumber;
        }

        return null;
    }

    public function setVatZoneNumber(int $vatZoneNumber)
    {
        if (isset($this->vatZone)) {
            $this->vatZone->vatZoneNumber = $vatZoneNumber;
        } else {
            $this->vatZone = $this->api->setClass('VatZone', 'vatZoneNumber');
            $this->vatZone->vatZoneNumber = $vatZoneNumber;
        }

        return $this;
    }

    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(string $lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    public function getBarred()
    {
        return $this->barred;
    }

    public function setBarred(?boolean $barred)
    {
        $this->barred = $barred;

        return $this;
    }

    public function getCorporateIdentificationNumber()
    {
        return $this->corporateIdentificationNumber;
    }

    public function setCorporateIdentificationNumber(?string $corporateIdentificationNumber)
    {
        $this->corporateIdentificationNumber = $corporateIdentificationNumber;

        return $this;
    }

    public function getCreditLimit()
    {
        return $this->creditLimit;
    }

    public function setCreditLimit(?float $creditLimit)
    {
        $this->creditLimit = $creditLimit;

        return $this;
    }

    public function getEan()
    {
        return $this->ean;
    }

    public function setEan(?string $ean)
    {
        $this->ean = $ean;

        return $this;
    }

    public function getPublicEntryNumber()
    {
        return $this->publicEntryNumber;
    }

    public function setPublicEntryNumber(?string $publicEntryNumber)
    {
        $this->publicEntryNumber = $publicEntryNumber;

        return $this;
    }

    public function getDeliveryLocations()
    {
        return $this->deliveryLocations;
    }

    public function setDeliveryLocations(string $deliveryLocations)
    {
        $this->deliveryLocations = $deliveryLocations;

        return $this;
    }

    public function getSalesPerson()
    {
        return $this->salesPerson;
    }

    public function setSalesPerson($salesPerson = null)
    {
        if (isset($salesPerson)) {
            $this->salesPerson = new SalesPerson($salesPerson->employeeNumber, $salesPerson->self);
        }

        return $this;
    }

    public function getSalesPersonNumber()
    {
        if (isset($this->salesPerson)) {
            return $this->salesPerson->employeeNumber;
        }

        return null;
    }

    public function setSalesPersonNumber(?int $employeeNumber)
    {
        if (isset($this->salesPerson)) {
            $this->salesPerson->employeeNumber = $employeeNumber;
        } else {
            $this->salesPerson = $this->api->setClass('SalesPerson', 'employeeNumber');
            $this->salesPerson->employeeNumber = $employeeNumber;
        }

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
}
