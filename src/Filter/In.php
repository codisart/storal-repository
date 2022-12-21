<?php

namespace Storal\Filter;

class In
{
    public function __construct(private string $field, private mixed $value)
    {
    }

    public function apply($where): void
    {
        $where->in($this->field, $this->value);
    }
}
