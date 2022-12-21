<?php

namespace Storal\Filter;

class GreaterThan
{
    public function __construct(private string $field, private mixed $value)
    {
    }

    public function apply($where): void
    {
        $where->greaterThan($this->field, $this->value);
    }
}
