<?php

namespace Storal\Filter;

class EqualTo
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
        $where->equalTo($this->field, $this->value);
    }
}
