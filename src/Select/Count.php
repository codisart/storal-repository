<?php

namespace Storal\Select;

use Laminas\Db\Sql\Literal;
use Laminas\Db\Sql\Select;

class Count extends Select
{
    public const COUNT_COLUMN = 'count';

    public function __construct(array|string|TableIdentifier|null $table = null)
    {
        parent::__construct($table);
        parent::columns([
            self::COUNT_COLUMN => new Literal('COUNT(1)'),
        ]);
    }

    public function columns(array $columns, $prefixColumnsWithTable = true)
    {
        throw new \BadMethodCallException('The columns should not be changed');
    }
}
