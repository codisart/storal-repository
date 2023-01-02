<?php

namespace Storal\Filter;

use Laminas\Db\Sql\Where;

class LessThan extends Filter
{
    public function apply(Where $where): void
    {
        $where->lessThan($this->field, $this->value);
    }
}
