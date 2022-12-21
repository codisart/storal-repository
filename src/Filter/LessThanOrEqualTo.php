<?php

namespace Storal\Filter;

class LessThanOrEqualTo
{
    public function __construct(private string $field, private mixed $value)
    {
    }

    public function apply($where): void
    {
        $where->lessThanOrEqualTo($this->field, $this->value);
    }
}
