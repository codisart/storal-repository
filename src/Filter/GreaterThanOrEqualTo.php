<?php

namespace Storal\Filter;

class GreaterThanOrEqualTo
{
    public function __construct(private string $field, private mixed $value)
    {
    }

    public function apply($where): void
    {
        $where->greaterThanOrEqualTo($this->field, $this->value);
    }
}
