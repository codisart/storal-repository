<?php

namespace Storal\Filter;

use Laminas\Db\Sql\Where;

class In extends Filter
{
    public function apply(Where $where): void
    {
        $where->in($this->field, $this->value);
    }
}
