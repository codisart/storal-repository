<?php

namespace Storal\Filter;

use Laminas\Db\Sql\Where;

class LessThanOrEqualTo extends Filter
{
    public function apply(Where $where): void
    {
        $where->lessThanOrEqualTo($this->field, $this->value);
    }
}
