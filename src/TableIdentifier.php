<?php

namespace Storal;

use Laminas\Db\Sql\TableIdentifier as LaminasTableIdentifier;

class TableIdentifier extends LaminasTableIdentifier
{
    public function column(string $columnName)
    {
        return new Column($columnName, new self($this->table, $this->schema));
    }

    public function getFullName()
    {
        if (!$this->schema) {
            return sprintf('"%s"', $this->table);
        }
        return sprintf('"%s"."%s"', $this->schema, $this->table);
    }
}
