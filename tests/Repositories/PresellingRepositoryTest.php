<?php namespace Tests\Repositories;

use App\Models\Preselling;
use Tests\TestCase;

class PresellingRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\PresellingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PresellingRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $presellings = factory(Preselling::class, 3)->create();
        $presellingIds = $presellings->pluck('id')->toArray();

        /** @var  \App\Repositories\PresellingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PresellingRepositoryInterface::class);
        $this->assertNotNull($repository);

        $presellingsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Preselling::class, $presellingsCheck[0]);

        $presellingsCheck = $repository->getByIds($presellingIds);
        $this->assertEquals(3, count($presellingsCheck));
    }

    public function testFind()
    {
        $presellings = factory(Preselling::class, 3)->create();
        $presellingIds = $presellings->pluck('id')->toArray();

        /** @var  \App\Repositories\PresellingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PresellingRepositoryInterface::class);
        $this->assertNotNull($repository);

        $presellingCheck = $repository->find($presellingIds[0]);
        $this->assertEquals($presellingIds[0], $presellingCheck->id);
    }

    public function testCreate()
    {
        $presellingData = factory(Preselling::class)->make();

        /** @var  \App\Repositories\PresellingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PresellingRepositoryInterface::class);
        $this->assertNotNull($repository);

        $presellingCheck = $repository->create($presellingData->toFillableArray());
        $this->assertNotNull($presellingCheck);
    }

    public function testUpdate()
    {
        $presellingData = factory(Preselling::class)->create();

        /** @var  \App\Repositories\PresellingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PresellingRepositoryInterface::class);
        $this->assertNotNull($repository);

        $presellingCheck = $repository->update($presellingData, $presellingData->toFillableArray());
        $this->assertNotNull($presellingCheck);
    }

    public function testDelete()
    {
        $presellingData = factory(Preselling::class)->create();

        /** @var  \App\Repositories\PresellingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PresellingRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($presellingData);

        $presellingCheck = $repository->find($presellingData->id);
        $this->assertNull($presellingCheck);
    }

}
