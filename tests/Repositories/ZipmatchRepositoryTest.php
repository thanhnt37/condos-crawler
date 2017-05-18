<?php namespace Tests\Repositories;

use App\Models\Zipmatch;
use Tests\TestCase;

class ZipmatchRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ZipmatchRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ZipmatchRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $zipmatches = factory(Zipmatch::class, 3)->create();
        $zipmatchIds = $zipmatches->pluck('id')->toArray();

        /** @var  \App\Repositories\ZipmatchRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ZipmatchRepositoryInterface::class);
        $this->assertNotNull($repository);

        $zipmatchesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Zipmatch::class, $zipmatchesCheck[0]);

        $zipmatchesCheck = $repository->getByIds($zipmatchIds);
        $this->assertEquals(3, count($zipmatchesCheck));
    }

    public function testFind()
    {
        $zipmatches = factory(Zipmatch::class, 3)->create();
        $zipmatchIds = $zipmatches->pluck('id')->toArray();

        /** @var  \App\Repositories\ZipmatchRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ZipmatchRepositoryInterface::class);
        $this->assertNotNull($repository);

        $zipmatchCheck = $repository->find($zipmatchIds[0]);
        $this->assertEquals($zipmatchIds[0], $zipmatchCheck->id);
    }

    public function testCreate()
    {
        $zipmatchData = factory(Zipmatch::class)->make();

        /** @var  \App\Repositories\ZipmatchRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ZipmatchRepositoryInterface::class);
        $this->assertNotNull($repository);

        $zipmatchCheck = $repository->create($zipmatchData->toFillableArray());
        $this->assertNotNull($zipmatchCheck);
    }

    public function testUpdate()
    {
        $zipmatchData = factory(Zipmatch::class)->create();

        /** @var  \App\Repositories\ZipmatchRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ZipmatchRepositoryInterface::class);
        $this->assertNotNull($repository);

        $zipmatchCheck = $repository->update($zipmatchData, $zipmatchData->toFillableArray());
        $this->assertNotNull($zipmatchCheck);
    }

    public function testDelete()
    {
        $zipmatchData = factory(Zipmatch::class)->create();

        /** @var  \App\Repositories\ZipmatchRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ZipmatchRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($zipmatchData);

        $zipmatchCheck = $repository->find($zipmatchData->id);
        $this->assertNull($zipmatchCheck);
    }

}
