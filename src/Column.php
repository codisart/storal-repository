<?php

namespace Storal;

use Laminas\Db\Sql\Expression;

class Column extends Expression
{
    public function __construct(string $columnName, TableIdentifier $table)
    {
        $expression = sprintf('%s.%s', $table->getFullName(), $columnName);
        parent::__construct($expression);
    }
}
