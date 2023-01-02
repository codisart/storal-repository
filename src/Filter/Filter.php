<?php

namespace Storal\Filter;

use Laminas\Db\Sql\Where;

abstract class Filter
{
    public function __construct(
        protected string $field,
        protected mixed $value
    ) {
    }

    abstract public function apply(Where $where): void;
}
