<?php

namespace Storal;

use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Adapter\Platform\Postgresql;
use Laminas\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;
use Storal\Select\Count;
use Storal\Select\Exists;

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
        $this->testedInstance = new class($tableGateway) extends Repository
        {
            public function existsVegetable(string $name) {
                $select = new Exists('vegetable');
                $select->where->equalTo('name', $name);
                return $this->fetchExists($select);
            }

            public function countVegetable(string $name) {
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
