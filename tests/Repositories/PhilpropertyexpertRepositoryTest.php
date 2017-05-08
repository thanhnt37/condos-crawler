<?php namespace Tests\Repositories;

use App\Models\Philpropertyexpert;
use Tests\TestCase;

class PhilpropertyexpertRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\PhilpropertyexpertRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhilpropertyexpertRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $philpropertyexperts = factory(Philpropertyexpert::class, 3)->create();
        $philpropertyexpertIds = $philpropertyexperts->pluck('id')->toArray();

        /** @var  \App\Repositories\PhilpropertyexpertRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhilpropertyexpertRepositoryInterface::class);
        $this->assertNotNull($repository);

        $philpropertyexpertsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Philpropertyexpert::class, $philpropertyexpertsCheck[0]);

        $philpropertyexpertsCheck = $repository->getByIds($philpropertyexpertIds);
        $this->assertEquals(3, count($philpropertyexpertsCheck));
    }

    public function testFind()
    {
        $philpropertyexperts = factory(Philpropertyexpert::class, 3)->create();
        $philpropertyexpertIds = $philpropertyexperts->pluck('id')->toArray();

        /** @var  \App\Repositories\PhilpropertyexpertRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhilpropertyexpertRepositoryInterface::class);
        $this->assertNotNull($repository);

        $philpropertyexpertCheck = $repository->find($philpropertyexpertIds[0]);
        $this->assertEquals($philpropertyexpertIds[0], $philpropertyexpertCheck->id);
    }

    public function testCreate()
    {
        $philpropertyexpertData = factory(Philpropertyexpert::class)->make();

        /** @var  \App\Repositories\PhilpropertyexpertRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhilpropertyexpertRepositoryInterface::class);
        $this->assertNotNull($repository);

        $philpropertyexpertCheck = $repository->create($philpropertyexpertData->toFillableArray());
        $this->assertNotNull($philpropertyexpertCheck);
    }

    public function testUpdate()
    {
        $philpropertyexpertData = factory(Philpropertyexpert::class)->create();

        /** @var  \App\Repositories\PhilpropertyexpertRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhilpropertyexpertRepositoryInterface::class);
        $this->assertNotNull($repository);

        $philpropertyexpertCheck = $repository->update($philpropertyexpertData, $philpropertyexpertData->toFillableArray());
        $this->assertNotNull($philpropertyexpertCheck);
    }

    public function testDelete()
    {
        $philpropertyexpertData = factory(Philpropertyexpert::class)->create();

        /** @var  \App\Repositories\PhilpropertyexpertRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhilpropertyexpertRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($philpropertyexpertData);

        $philpropertyexpertCheck = $repository->find($philpropertyexpertData->id);
        $this->assertNull($philpropertyexpertCheck);
    }

}
