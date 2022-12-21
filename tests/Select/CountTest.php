<?php

namespace Storal\Select;

use Laminas\Db\Adapter\Platform\Postgresql;
use PHPUnit\Framework\TestCase;

class CountTest extends TestCase
{
    public function testInstance()
    {
        $select = (new Count())->from('carot');
        $select->where("color = 'purple'");

        $platform = new class() extends Postgresql {
            public function quoteValue($value)
            {
                return '"' . $value . '"';
            }
        };

        self::assertSame(
            'SELECT COUNT(1) AS "count" FROM "carot" WHERE color = \'purple\'',
            $select->getSqlString($platform)
        );
    }
}
