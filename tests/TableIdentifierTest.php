<?php

namespace Storal;

use Laminas\Db\Adapter\Platform\Postgresql;
use Laminas\Db\Sql\Select;
use PHPUnit\Framework\TestCase;

class TableIdentifierTest extends TestCase
{
    public function testSelectSimpleTable()
    {
        $groupTable = new TableIdentifier('group');
        $select = (new Select())->from($groupTable);

        $ownerId = $groupTable->column('owner_id');

        $select->columns(['owner_id' => $ownerId]);

        self::assertSame(
            'SELECT "group".owner_id AS "owner_id" FROM "group"',
            $select->getSqlString()
        );
    }

    public function testSelectTableWithSchema()
    {
        $groupTable = new TableIdentifier('group', 'invoicing');
        $select = (new Select())->from($groupTable);

        $ownerId = $groupTable->column('owner_id');

        $select->columns(['owner_id' => $ownerId]);

        $select->where
            ->equalTo($ownerId, 4);

        $platform = new class() extends Postgresql {
            public function quoteValue($value)
            {
                return $value;
            }
        };

        self::assertSame(
            'SELECT "invoicing"."group".owner_id AS "owner_id" FROM "invoicing"."group" WHERE "invoicing"."group".owner_id = 4',
            $select->getSqlString($platform)
        );
    }
}
