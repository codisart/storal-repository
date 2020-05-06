<?php

namespace Storal\Order;

use Laminas\Db\Sql\Expression;
use Storal\Column;

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
