<?php

namespace Storal\Filter;

use Laminas\Db\Sql\Where;

class GreaterThan extends Filter
{
    public function apply(Where $where): void
    {
        $where->greaterThan($this->field, $this->value);
    }
}
