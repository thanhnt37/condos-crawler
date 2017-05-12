<?php namespace Tests\Repositories;

use App\Models\Avidaland;
use Tests\TestCase;

class AvidalandRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\AvidalandRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AvidalandRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $avidalands = factory(Avidaland::class, 3)->create();
        $avidalandIds = $avidalands->pluck('id')->toArray();

        /** @var  \App\Repositories\AvidalandRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AvidalandRepositoryInterface::class);
        $this->assertNotNull($repository);

        $avidalandsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Avidaland::class, $avidalandsCheck[0]);

        $avidalandsCheck = $repository->getByIds($avidalandIds);
        $this->assertEquals(3, count($avidalandsCheck));
    }

    public function testFind()
    {
        $avidalands = factory(Avidaland::class, 3)->create();
        $avidalandIds = $avidalands->pluck('id')->toArray();

        /** @var  \App\Repositories\AvidalandRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AvidalandRepositoryInterface::class);
        $this->assertNotNull($repository);

        $avidalandCheck = $repository->find($avidalandIds[0]);
        $this->assertEquals($avidalandIds[0], $avidalandCheck->id);
    }

    public function testCreate()
    {
        $avidalandData = factory(Avidaland::class)->make();

        /** @var  \App\Repositories\AvidalandRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AvidalandRepositoryInterface::class);
        $this->assertNotNull($repository);

        $avidalandCheck = $repository->create($avidalandData->toFillableArray());
        $this->assertNotNull($avidalandCheck);
    }

    public function testUpdate()
    {
        $avidalandData = factory(Avidaland::class)->create();

        /** @var  \App\Repositories\AvidalandRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AvidalandRepositoryInterface::class);
        $this->assertNotNull($repository);

        $avidalandCheck = $repository->update($avidalandData, $avidalandData->toFillableArray());
        $this->assertNotNull($avidalandCheck);
    }

    public function testDelete()
    {
        $avidalandData = factory(Avidaland::class)->create();

        /** @var  \App\Repositories\AvidalandRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AvidalandRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($avidalandData);

        $avidalandCheck = $repository->find($avidalandData->id);
        $this->assertNull($avidalandCheck);
    }

}
