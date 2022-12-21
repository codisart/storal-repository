<?php

namespace Storal\Order;

use PHPUnit\Framework\TestCase;
use Storal\TableIdentifier;

class NotNullFirstTest extends TestCase
{
    public function testInstance()
    {
        $groupTable = new TableIdentifier('group');
        $column = $groupTable->column('owner_id');

        $expression = new NotNullFirst($column);
        self::assertSame(
            'ISNULL("group".owner_id) ASC',
            $expression->getExpression()
        );
    }
}
