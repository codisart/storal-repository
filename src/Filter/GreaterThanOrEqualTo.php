<?php

namespace Storal\Filter;

use Laminas\Db\Sql\Where;

class GreaterThanOrEqualTo extends Filter
{
    public function apply(Where $where): void
    {
        $where->greaterThanOrEqualTo($this->field, $this->value);
    }
}
