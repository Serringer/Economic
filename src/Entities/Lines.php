<?php


namespace Serringer\Economic\Entities;


class Lines
{
    private $lines = [];

    /**
     * Lines constructor.
     * @param  array  $lines
     */
    public function __construct(array $lines)
    {
        $this->lines = $lines;
    }

    public function addLine(array $line)
    {
        $this->lines[] = $line;
        return $this;
    }

    public function toArray()
    {
        return $this->lines;
    }
}
