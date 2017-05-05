<?php namespace Tests\Repositories;

use App\Models\Condominiumsmanila;
use Tests\TestCase;

class CondominiumsmanilaRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CondominiumsmanilaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CondominiumsmanilaRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $condominiumsmanilas = factory(Condominiumsmanila::class, 3)->create();
        $condominiumsmanilaIds = $condominiumsmanilas->pluck('id')->toArray();

        /** @var  \App\Repositories\CondominiumsmanilaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CondominiumsmanilaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $condominiumsmanilasCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Condominiumsmanila::class, $condominiumsmanilasCheck[0]);

        $condominiumsmanilasCheck = $repository->getByIds($condominiumsmanilaIds);
        $this->assertEquals(3, count($condominiumsmanilasCheck));
    }

    public function testFind()
    {
        $condominiumsmanilas = factory(Condominiumsmanila::class, 3)->create();
        $condominiumsmanilaIds = $condominiumsmanilas->pluck('id')->toArray();

        /** @var  \App\Repositories\CondominiumsmanilaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CondominiumsmanilaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $condominiumsmanilaCheck = $repository->find($condominiumsmanilaIds[0]);
        $this->assertEquals($condominiumsmanilaIds[0], $condominiumsmanilaCheck->id);
    }

    public function testCreate()
    {
        $condominiumsmanilaData = factory(Condominiumsmanila::class)->make();

        /** @var  \App\Repositories\CondominiumsmanilaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CondominiumsmanilaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $condominiumsmanilaCheck = $repository->create($condominiumsmanilaData->toFillableArray());
        $this->assertNotNull($condominiumsmanilaCheck);
    }

    public function testUpdate()
    {
        $condominiumsmanilaData = factory(Condominiumsmanila::class)->create();

        /** @var  \App\Repositories\CondominiumsmanilaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CondominiumsmanilaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $condominiumsmanilaCheck = $repository->update($condominiumsmanilaData, $condominiumsmanilaData->toFillableArray());
        $this->assertNotNull($condominiumsmanilaCheck);
    }

    public function testDelete()
    {
        $condominiumsmanilaData = factory(Condominiumsmanila::class)->create();

        /** @var  \App\Repositories\CondominiumsmanilaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CondominiumsmanilaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($condominiumsmanilaData);

        $condominiumsmanilaCheck = $repository->find($condominiumsmanilaData->id);
        $this->assertNull($condominiumsmanilaCheck);
    }

}
