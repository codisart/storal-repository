<?php

namespace Storal\Order;

use Storal\Column;
use Laminas\Db\Sql\Expression;

class NotNullFirst extends Expression
{
    public function __construct(Column $column)
    {
        $expression = 'ISNULL(%s) ASC';
        parent::__construct(
            sprintf($expression, $column->getExpression())
        );
    }
}