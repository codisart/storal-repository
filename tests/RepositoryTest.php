<?php

namespace Storal;

use Laminas\Db\TableGateway\TableGateway;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class RepositoryTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    private Repository $testedInstance;

    private m\MockInterface $tableGateway;

    protected function setUp(): void
    {
        $this->tableGateway = m::mock(TableGateway::class);

        $this->testedInstance = new class($this->tableGateway) extends Repository {};
    }

    public function testInstance()
    {
        self::assertInstanceOf(Repository::class, $this->testedInstance);
    }
}
