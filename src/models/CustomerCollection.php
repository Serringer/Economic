<?php


namespace Serringer\Economic\Models;


use Serringer\Economic\Economic;
use Serringer\Economic\Filter;

class CustomerCollection
{
    private $api;

    public function __construct(Economic $api)
    {
        $this->api = $api;
    }

    public function all(Filter $filter = null)
    {
        if (isset($filter)) {
            return $this->api->collection('customers?'.$filter->filter().'&', new Customer($this->api));
        } else {
            return $this->api->collection('customers?', new Customer($this->api));
        }
    }
}
