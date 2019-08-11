<?php

namespace Storal;

use Storal\Enums\FilterType;
use Storal\ValueObjects\QueryFilter;
use PHPUnit\Framework\TestCase;
use Laminas\Db\Sql\Where;
use Laminas\Db\TableGateway\TableGateway;
use Storal\Select\Exists;
use Laminas\Db\Adapter\Platform\Postgresql;
use Laminas\Db\Adapter\Driver\Pdo;
use Laminas\Db\Adapter\Driver\Pgsql;
use Laminas\Db\Adapter\Adapter;

class RepositoryTest extends TestCase
{
    /**
     * @var Repository
     */
    private $testedInstance;

    /**
     * @var m\MockInterface
     */
    private $tableGateway;

    protected function setUp(): void
    {
        $adapter = new Adapter([
            'driver' => 'pgsql',
            'database' => 'storal',
            'username' => 'postgres',
            'password' => ''
        ]);

        $tableGateway = new TableGateway('vegetable', $adapter);
        $this->testedInstance = new class($tableGateway) extends Repository {
            public function existsVegetable(string $name) {
                $select = new Exists('vegetable');
                $select->where->equalTo('name', $name);
                return $this->fetchExists($select);
            }
        };
    }

    public function testInstance()
    {
        self::assertInstanceOf(Repository::class, $this->testedInstance);
    }

    public function testFetchExist()
    {
        $result = $this->testedInstance->existsVegetable('potato');
        self::assertTrue($result);
    }

    public function testFetchDoNotExist()
    {
        $result = $this->testedInstance->existsVegetable('carrot');
        self::assertFalse($result);
    }
}
