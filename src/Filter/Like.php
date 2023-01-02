<?php

namespace Storal\Filter;

use Laminas\Db\Sql\Where;

class Like extends Filter
{
    public function apply(Where $where): void
    {
        $where->like($this->field, '%' . $this->value . '%');
    }
}
