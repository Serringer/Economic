<?php


namespace Serringer\Economic;

class Filter
{
    private $filterable;
    private $operator;
    private $value;
    private $string = null;

    public function __construct($filterable = [], $operator = [], $value = [])
    {
        $this->filterable = $filterable;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function filter()
    {
        foreach ($this->filterable as $key => $value) {
            if (is_null($this->string)) {
                $this->string = 'filter='.$this->filterable[$key].$this->operator[$key].$this->value[$key];
            } else {
                $this->string .= '$and:'.$this->filterable[$key].$this->operator[$key].$this->value[$key];
            }
        }

        return $this->string;
    }
}
