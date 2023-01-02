<?php

namespace Storal\Filter;

use Laminas\Db\Sql\Where;

class EqualTo extends Filter
{
    public function apply(Where $where): void
    {
        $where->equalTo($this->field, $this->value);
    }
}
