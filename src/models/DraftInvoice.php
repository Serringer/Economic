<?php


namespace Serringer\Economic\Models;

use Serringer\Economic\Economic;
use Serringer\Economic\Entities\Line;
use Serringer\Economic\Validators\DraftInvoiceValidator;

class DraftInvoice
{
    /** @var int */
    private $draftInvoiceNumber;
    /** @var string */
    private $currency;
    /** @var Customer */
    private $customer;
    /** @var string */
    private $date;
    /** @var Layout */
    private $layout;
    /** @var PaymentTerms */
    private $paymentTerms;
    /** @var Recipient */
    public $recipient;
    /** @var References */
    public $references;
    /** @var int */
    private $costPriceInBaseCurrency;
    /** @var string */
    private $dueDate;
    /** @var int */
    private $exchangeRate;
    /** @var int */
    private $grossAmount;
    /** @var int */
    private $grossAmountInBaseCurrency;
    /** @var int */
    private $marginInBaseCurrency;
    /** @var int */
    private $marginPercentage;
    /** @var int */
    private $netAmount;
    /** @var int */
    private $netAmountInBaseCurrency;
    /** @var Notes */
    private $notes;
    /** @var Pdf */
    private $pdf;
    /** @var Project */
    private $project;
    /** @var array */
    private $lines = [];
    /** @var int */
    private $roundingAmount;
    /** @var string */
    private $self;
    /** @var int */
    private $vatAmount;

    /** @var Economic */
    private $api;

    /**
     * @param  Economic  $api
     */
    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    /**
     * @param  Economic  $api
     * @param  \stdClass  $object
     * @return self
     */
    public static function transform($api, $object): self
    {
        var_dump($object);

        $draftInvoices = new self($api);

        $draftInvoices->setDraftInvoiceNumber($object->draftInvoiceNumber);
        $draftInvoices->setCurrency($object->currency);
        $draftInvoices->setCustomer($object->customer);
        $draftInvoices->setDate($object->date);
        $draftInvoices->setLayout($object->layout);
        $draftInvoices->setPaymentTerms($object->paymentTerms);
        $draftInvoices->setRecipient($object->recipient);
        $draftInvoices->setReferences($object->references ?? null);
        $draftInvoices->setCostPriceInBaseCurrency($object->costPriceInBaseCurrency);
        $draftInvoices->setDueDate($object->dueDate);
        $draftInvoices->setExchangeRate($object->exchangeRate);
        $draftInvoices->setGrossAmount($object->grossAmount);
        $draftInvoices->setGrossAmountInBaseCurrency($object->grossAmountInBaseCurrency ?? null);
        $draftInvoices->setMarginInBaseCurrency($object->marginInBaseCurrency);
        $draftInvoices->setMarginPercentage($object->marginPercentage);
        $draftInvoices->setNetAmount($object->netAmount);
        $draftInvoices->setNetAmountInBaseCurrency($object->netAmountInBaseCurrency);
        $draftInvoices->setNotes($object->notes ?? null);
        $draftInvoices->setPdf($object->pdf);
        $draftInvoices->setProject($object->project ?? null);
        $draftInvoices->setLines($object->lines ?? null);
        $draftInvoices->setRoundingAmount($object->roundingAmount);
        $draftInvoices->setSelf($object->self);
        $draftInvoices->setVatAmount($object->vatAmount);

        return $draftInvoices;
    }

    /**
     * @param  Filter  $filter
     * @return self
     */
    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->api->collection('/invoices/drafts?'.$filter->filter().'&', $this);
        } else {
            return $this->api->collection('/invoices/drafts?', $this);
        }
    }

    /**
     * @param  int  $id
     * @return self
     */
    public function get($id)
    {
        return self::transform($this->api, $this->api->get('/invoices/drafts/'.$id));
    }

    public function create()
    {
        $data = (object) [
            'currency' => $this->getCurrency(),
            'customer' => $this->getCustomer(),
            'date' => $this->getDate(),
            'dueDate' => $this->getDueDate(),
            'exchangeRate' => $this->getExchangeRate(),
            'grossAmount' => $this->getGrossAmount(),
            'layout' => $this->getLayout(),
            'notes' => $this->getNotes(),
            'project' => $this->getProject(),
            'paymentTerms' => $this->getPaymentTerms(),
            'recipient' => $this->getRecipient(),
            'references' => $this->getReferences(),
            'lines' => $this->getLines(),
        ];

        $this->api->cleanObject($data);

        $validator = DraftInvoiceValidator::getValidator();
        if (! $validator->validate($this)) {
            throw $validator->getException($this);
        }

        return self::transform($this->api, $this->api->create('/invoices/drafts', $data));
    }

    public function update()
    {
        $data = (object) [
            'costPriceInBaseCurrency' => $this->getCostPriceInBaseCurrency(),
            'currency' => $this->getCurrency(),
            'customer' => $this->getCustomer(),
            'date' => $this->getDate(),
            'dueDate' => $this->getDueDate(),
            'exchangeRate' => $this->getExchangeRate(),
            'grossAmount' => $this->getGrossAmount(),
            'grossAmountInBaseCurrency' => $this->getGrossAmountInBaseCurrency(),
            'lines' => $this->getLines(),
            'marginInBaseCurrency' => $this->getMarginInBaseCurrency(),
            'marginPercentage' => $this->getMarginPercentage(),
            'netAmountInBaseCurrency' => $this->getNetAmountInBaseCurrency(),
            'notes' => $this->getNotes(),
            'paymentTerms' => $this->getPaymentTerms(),
            'project' => $this->getProject(),
            'recipient' => $this->getRecipient(),
            'references' => $this->getReferences(),
            'roundingAmount' => $this->getRoundingAmount(),
            'vatAmount' => $this->getVatAmount(),
        ];

        $this->api->cleanObject($data);

        return self::transform(
            $this->api,
            $this->api->update('/invoices/drafts/'.$this->getDraftInvoiceNumber(), $data)
        );
    }

    /**
     * @return Invoice
     */
    public function bookInvoice(): Invoice
    {
        $data = [
            'draftInvoice' => [
                'draftInvoiceNumber' => $this->getDraftInvoiceNumber(),
            ],
        ];

        return Invoice::transform($this->api, $this->api->create('/invoices/booked', $data));
    }

    // Getters & Setters

    /**
     * @return Notes
     */
    public function getNotes(): ?Notes
    {
        return $this->notes;
    }

    /**
     * @param  Notes  $notes
     * @return $this
     */
    public function setNotes($notes = null)
    {
        if (isset($notes)) {
            $this->notes = new Notes($notes->heading, $notes->textLine1, $notes->textLine2);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getNoteHeading(): ?string
    {
        if (isset($this->notes)) {
            return $this->notes->heading;
        }

        return null;
    }

    /**
     * @param  string  $heading
     * @return $this
     */
    public function setNoteHeading(string $heading)
    {
        if (isset($this->notes)) {
            $this->notes->heading = $heading;
        } else {
            $this->notes = $this->api->setClass('Notes', 'heading');
            $this->notes->heading = $heading;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getNoteTextLine1(): ?string
    {
        if (isset($this->notes)) {
            return $this->notes->textLine1;
        }

        return null;
    }

    /**
     * @param  string  $textLine1
     * @return $this
     */
    public function setNoteTextLine1(string $textLine1)
    {
        if (isset($this->notes)) {
            $this->notes->textLine1 = $textLine1;
        } else {
            $this->notes = $this->api->setClass('Notes', 'textLine1');
            $this->notes->textLine1 = $textLine1;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getNoteTextLine2(): ?string
    {
        if (isset($this->notes)) {
            return $this->notes->textLine2;
        }

        return null;
    }

    /**
     * @param  string  $textLine2
     * @return $this
     */
    public function setNoteTextLine2(string $textLine2)
    {
        if (isset($this->notes)) {
            $this->notes->textLine1 = $textLine2;
        } else {
            $this->notes = $this->api->setClass('Notes', 'textLine2');
            $this->notes->textLine2 = $textLine2;
        }

        return $this;
    }

    /**
     * @return Pdf
     */
    public function getPdf(): ?Pdf
    {
        return $this->pdf;
    }

    /**
     * @param $pdf
     * @return $this
     */
    public function setPdf($pdf)
    {
        $this->pdf = new Pdf($pdf->download);

        return $this;
    }

    /**
     * @return Project
     */
    public function getProject(): ?Project
    {
        return $this->project;
    }

    /**
     * @param  Project  $project
     * @return $this
     */
    public function setProject($project = null)
    {
        if (isset($project)) {
            $this->project = new Project($project->projectNumber, $project->self);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getProjectNumber(): ?int
    {
        if (isset($this->project)) {
            return $this->project->projectNumber;
        }

        return null;
    }

    /**
     * @param  int  $projectNumber
     * @return $this
     */
    public function setProjectNumber(int $projectNumber)
    {
        if (isset($this->project)) {
            $this->project->projectNumber = $projectNumber;
        } else {
            $this->project = $this->api->setClass('Project', 'projectNumber');
            $this->project->projectNumber = $projectNumber;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getRoundingAmount(): ?int
    {
        return $this->roundingAmount;
    }

    /**
     * @param  int  $roundingAmount
     * @return $this
     */
    public function setRoundingAmount(int $roundingAmount)
    {
        $this->roundingAmount = $roundingAmount;

        return $this;
    }

    public function getSelf(): ?string
    {
        return $this->self;
    }

    public function setSelf(string $self)
    {
        $this->self = $self;

        return $this;
    }

    public function getVatAmount(): ?int
    {
        return $this->vatAmount;
    }

    public function setVatAmount(int $vatAmount)
    {
        $this->vatAmount = $vatAmount;

        return $this;
    }

    public function getMarginInBaseCurrency(): ?int
    {
        return $this->marginInBaseCurrency;
    }

    public function setMarginInBaseCurrency(int $marginInBaseCurrency)
    {
        $this->marginInBaseCurrency = $marginInBaseCurrency;

        return $this;
    }

    public function getMarginPercentage(): ?int
    {
        return $this->marginPercentage;
    }

    public function setMarginPercentage(int $marginPercentage)
    {
        $this->marginPercentage = $marginPercentage;

        return $this;
    }

    public function getNetAmount(): ?int
    {
        return $this->netAmount;
    }

    public function setNetAmount(int $netAmount)
    {
        $this->netAmount = $netAmount;

        return $this;
    }

    public function getNetAmountInBaseCurrency(): ?int
    {
        return $this->netAmountInBaseCurrency;
    }

    public function setNetAmountInBaseCurrency(int $netAmountInBaseCurrency)
    {
        $this->netAmountInBaseCurrency = $netAmountInBaseCurrency;

        return $this;
    }

    public function getCostPriceInBaseCurrency(): ?int
    {
        return $this->costPriceInBaseCurrency;
    }

    public function setCostPriceInBaseCurrency(int $costPriceInBaseCurrency)
    {
        $this->costPriceInBaseCurrency = $costPriceInBaseCurrency;

        return $this;
    }

    public function getDueDate(): ?string
    {
        return $this->dueDate;
    }

    public function setDueDate(string $dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getExchangeRate(): ?int
    {
        return $this->exchangeRate;
    }

    public function setExchangeRate(int $exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    public function getGrossAmount(): ?int
    {
        return $this->grossAmount;
    }

    public function setGrossAmount(int $grossAmount)
    {
        $this->grossAmount = $grossAmount;

        return $this;
    }

    public function getGrossAmountInBaseCurrency(): ?int
    {
        return $this->grossAmountInBaseCurrency;
    }

    public function setGrossAmountInBaseCurrency(?int $grossAmountInBaseCurrency)
    {
        $this->grossAmountInBaseCurrency = $grossAmountInBaseCurrency;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($customer)
    {
        $this->customer = [
            "customerNumber" => $customer->getCustomerNumber(),
            "self" => $customer->getSelf(),
        ];

        return $this;
    }

    public function getCustomerNumber(): ?int
    {
        if (isset($this->customer)) {
            return $this->customer["customerNumber"];
        }

        return null;
    }

    public function setCustomerNumber(int $customerNumber)
    {
        if (isset($this->customer)) {
            $this->customer = ["customerNumber" => $customerNumber];
        }

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date)
    {
        $this->date = $date;

        return $this;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function setLayout($layout)
    {
        if (is_array($layout)) {
            $this->layout = [
                "layoutNumber" => $layout->getLayoutNumber(),
                "self" => $layout->getSelf(),
            ];
        } else {
            $this->layout = ["layoutNumber" => $layout];
        }

        return $this;
    }

    public function getLayoutNumber(): ?int
    {
        if (isset($this->layout)) {
            return $this->layout->layoutNumber;
        }

        return null;
    }

    public function setLayoutNumber(int $layoutNumber)
    {
        if (isset($this->layout)) {
            $this->layout["layoutNumber"] = $layoutNumber;
        }

        return $this;
    }

    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = [
            "paymentTermsNumber" => $paymentTerms->paymentTermsNumber,
            "self" => $paymentTerms->self,
        ];

        return $this;
    }

    public function getPaymentTermsNumber(): ?int
    {
        if (isset($this->paymentTerms)) {
            return $this->paymentTerms->paymentTermsNumber;
        }

        return null;
    }

    public function setPaymentTermsNumber(int $paymentTermsNumber)
    {
        if (isset($this->paymentTerms)) {
            $this->paymentTerms = [
                "paymentTermsNumber" => $paymentTermsNumber,
            ];
        }

        return $this;
    }

    public function getRecipient(): ?Recipient
    {
        return $this->recipient;
    }

    public function setRecipient($recipient)
    {
        if ($recipient != null) {
            $this->recipient = [
                "name" => $recipient["name"],
                "vatZone" => $recipient["vatZone"],
            ];
        }

        return $this;
    }

    public function getRecipientName(): ?string
    {
        if (isset($this->recipient)) {
            return $this->recipient->name;
        }

        return null;
    }

    public function getRecipientVatZone(): ?VatZone
    {
        if (isset($this->recipient->vatZone)) {
            return $this->recipient->vatZone;
        }

        return null;
    }

    public function setRecipientName(string $name)
    {
        if (isset($this->recipient)) {
            $this->recipient->name = $name;
        } else {
            $this->recipient = $this->api->setClass('Recipient', 'name');
            $this->recipient->name = $name;
        }

        return $this;
    }

    public function getRecipientVatZoneNumber(): ?int
    {
        if (isset($this->recipient->vatZone)) {
            return $this->recipient->vatZone->vatZoneNumber;
        }

        return null;
    }

    public function setRecipientVatZoneNumber(int $vatZoneNumber)
    {
        if (isset($this->recipient->vatZone)) {
            $this->recipient->vatZone->vatZoneNumber = $vatZoneNumber;
        } else {
            $this->recipient = $this->api->setClass('Recipient', 'vatZone', $this);
            $this->recipient->vatZone->vatZoneNumber = $vatZoneNumber;
        }

        return $this;
    }

    public function getReferences(): ?References
    {
        return $this->references;
    }

    public function getReferencesSalesPerson(): ?SalesPerson
    {
        if (isset($this->references->salesPerson)) {
            return $this->references->salesPerson;
        }

        return null;
    }

    public function getReferencesVendorReference(): ?VendorReference
    {
        if (isset($this->references->vendorReference)) {
            return $this->references->vendorReference;
        }

        return null;
    }

    public function setReferences($reference = null)
    {
        if (isset($reference)) {
            $this->references = new References($reference->vendorReference, $reference->salesPerson);
        }

        return $this;
    }

    /** @return int */
    public function getSalesPersonNumber(): ?int
    {
        if (isset($this->references->salesPerson)) {
            return $this->references->salesPerson->employeeNumber;
        }

        return null;
    }

    public function setSalesPersonNumber(int $employeeNumber)
    {
        if (isset($this->references->salesPerson)) {
            $this->references->salesPerson->employeeNumber = $employeeNumber;
        } else {
            $this->references = $this->api->setClass('References', 'salesPerson', $this);
            $this->references->salesPerson->employeeNumber = $employeeNumber;
        }

        return $this;
    }

    public function getVendorReferenceNumber(): ?int
    {
        if (isset($this->references->vendorReference)) {
            return $this->references->vendorReference->employeeNumber;
        }

        return null;
    }

    public function setVendorReferenceNumber(int $employeeNumber)
    {
        if (isset($this->references->vendorReference)) {
            $this->references->vendorReference->employeeNumber = $employeeNumber;
        } else {
            $this->references = $this->api->setClass('References', 'vendorReference', $this);
            $this->references->vendorReference->employeeNumber = $employeeNumber;
        }

        return $this;
    }

    public function getDraftInvoiceNumber()
    {
        return $this->draftInvoiceNumber;
    }

    public function setDraftInvoiceNumber($draftInvoiceNumber)
    {
        $this->draftInvoiceNumber = $draftInvoiceNumber;

        return $this;
    }

    public function getLines(): array
    {
        return $this->lines;
    }

    public function setLines($lines = null)
    {
        if (isset($lines)) {
            foreach ($lines as $line) {
                $this->lines[] = new Line(
                    $line->product->productNumber,
                    $line->description,
                    $line->quantity,
                    $line->unitNetPrice,
                    $line->discountPercentage
                );
            }
        }

        return $this;
    }

    public function setInvoiceLine(
        string $productNumber,
        string $name,
        int $quantity,
        float $price,
        float $discountPercentage = 0
    ) {
        $this->lines[] = new Line($productNumber, $name, $quantity, $price, $discountPercentage);

        return $this;
    }
}
