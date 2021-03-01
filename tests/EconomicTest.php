<?php


use PHPUnit\Framework\TestCase;

class EconomicTest extends TestCase
{
    public $tokens = [
        'secret' => [
            'FysDGcnv13KQh5s6LHr5DoC36X3DyVSVz2UemBwNACw1',
        ],
        'agreement' => [
            '8dWxoeqaoVxRhDE4ZFs0miD6Hf1xiDgpiMGsbu9uyw01',
        ],
    ];

    /** @test */
    public function class_is_available()
    {
        $economic = new Serringer\Economic\Economic('demo', 'demo');

        $this->assertIsObject($economic);
    }

    /** @test */
    public function test_demo_connection()
    {
        $secret_tokens = $this->tokens['secret'][0];
        $agreement = $this->tokens['agreement'][0];

        $economic = new Serringer\Economic\Economic($secret_tokens, $agreement);
        $result = $economic->customer();

        $this->assertIsObject($result);
    }

    /** @test */
    public function we_have_customers()
    {
        $secret_tokens = $this->tokens['secret'][0];
        $agreement = $this->tokens['agreement'][0];

        $economic = new Serringer\Economic\Economic($secret_tokens, $agreement);
        $collection = $economic->customerCollection()->all();

        $this->assertIsArray($collection);
        $this->assertTrue(count($collection) > 0);
    }

    /** @test */
    public function got_a_random_customer()
    {
        $secret_tokens = $this->tokens['secret'][0];
        $agreement = $this->tokens['agreement'][0];

        $economic = new Serringer\Economic\Economic($secret_tokens, $agreement);
        $collection = $economic->customerCollection()->all();

        $this->assertIsArray($collection);

        $random_customer = $economic->customer($collection[array_rand($collection)]->getCustomerNumber());
        $this->assertTrue(true);
    }

    /** @test */
    public function list_of_customers_invoices()
    {
        $secret_tokens = $this->tokens['secret'][0];
        $agreement = $this->tokens['agreement'][0];

        $economic = new Serringer\Economic\Economic($secret_tokens, $agreement);

        $customer = $economic->customer()->get(1000);
        $invoices = $customer->bookedInvoices();
        $this->assertTrue(count($invoices) > 0);
    }

    /** @test */
    public function create_invoice()
    {
        $secret_tokens = $this->tokens['secret'][0];
        $agreement = $this->tokens['agreement'][0];

        $economic = new Serringer\Economic\Economic($secret_tokens, $agreement);

        $customer = $economic->customer()->get(1000);
        $products = $economic->products()->all();

        $current_date = date('Y-m-d');
        $due_date = date('Y-m-d', strtotime('+ 14 days'));

        $draftInvoice = $economic->draftInvoices()
            ->setCurrency('DKK')
            ->setCustomer($customer)
            ->setDate($current_date)
            ->setDueDate($due_date)
            ->setExchangeRate(1)
            ->setGrossAmount(1)
            ->setLayout(1)
            ->setPaymentTermsNumber(1)
            ->setRecipient(null)
            ->setInvoiceLine(
                $products[1]->getProductNumber(),
                'produkt',
                1,
                100.00,
                0.00
            )->create();
    }
}
