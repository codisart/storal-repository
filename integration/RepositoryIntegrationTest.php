<?php

namespace Storal;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\TableGateway;
use PHPUnit\Framework\TestCase;

class RepositoryIntegrationTest extends TestCase
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
            'password' => 'postgres',
            'hostname' => 'database',
        ]);
        $adapter->query(
            'DROP TABLE vegetable',
            Adapter::QUERY_MODE_EXECUTE
        );
        $adapter->query(
            'CREATE TABLE vegetable (
            id SERIAL PRIMARY KEY,
            name TEXT
            )',
            Adapter::QUERY_MODE_EXECUTE
        );
        $adapter->query(
            "INSERT INTO vegetable (name) VALUES ('potato')",
            Adapter::QUERY_MODE_EXECUTE
        );

        $tableGateway = new TableGateway('vegetable', $adapter);
        $this->testedInstance = new class($tableGateway) extends Repository {
            public function existsVegetable(string $name)
            {
                $select = $this->exists();
                $select->where->equalTo('name', $name);

                return $this->fetchExists($select);
            }

            public function countVegetable(string $name)
            {
                $select = $this->count();
                $select->where->equalTo('name', $name);

                return $this->fetchCount($select);
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

    public function testFetchCountPotatoes()
    {
        $result = $this->testedInstance->countVegetable('potato');
        self::assertSame(1, $result);
    }

    public function testFetchCountCarrots()
    {
        $result = $this->testedInstance->countVegetable('carrot');
        self::assertSame(0, $result);
    }
}
