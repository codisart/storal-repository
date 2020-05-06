<?php

namespace Storal\Filter;

class In
{
    /** @var string */
    private $field;

    /** @var mixed */
    private $value;

    /**
     * @param mixed $value
     */
    public function __construct(string $field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function apply($where): void
    {
        $where->in($this->field, $this->value);
    }
}
