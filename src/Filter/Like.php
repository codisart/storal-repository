<?php

namespace Storal\Filter;

class Like
{
    public function __construct(private string $field, private mixed $value)
    {
    }

    public function apply($where): void
    {
        $where->like($this->field, '%' . $this->value . '%');
    }
}
