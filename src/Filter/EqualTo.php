<?php

namespace Storal\Filter;

class EqualTo
{
    public function __construct(private string $field, private mixed $value)
    {
    }

    public function apply($where): void
    {
        $where->equalTo($this->field, $this->value);
    }
}
