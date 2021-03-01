<?php


namespace Serringer\Economic\Exceptions;

use Throwable;

class EconomicValidationException extends \Exception
{
    protected $orgMessage;
    protected $properties = [];

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct('Properties not filled in model: ', $code, $previous);

        $this->orgMessage = $this->message;
    }

    public function addProperty($property)
    {
        $this->properties[] = $property;

        $this->updateMessage();
    }

    private function updateMessage()
    {
        $this->message = $this->orgMessage.implode(', ', $this->properties).'.';
    }
}
