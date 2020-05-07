<?php

namespace Storal\Filter;

use Storal\Enums\FilterType;

class Like
{
    /** @var string */
    private $field;

    /** @var mixed */
    private $value;

    /**
     * @param string $field
     * @param mixed $value
     */
    public function __construct(string $field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function apply($where)
    {
        $where->like($this->field, '%' . $this->value . '%');
    }
}
