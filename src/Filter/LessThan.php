<?php

namespace Storal\Filter;

class LessThan
{
    public function __construct(private string $field, private mixed $value)
    {
    }

    public function apply($where): void
    {
        $where->lessThan($this->field, $this->value);
    }
}
