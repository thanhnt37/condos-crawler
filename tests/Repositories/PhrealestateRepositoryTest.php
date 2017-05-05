<?php namespace Tests\Repositories;

use App\Models\Phrealestate;
use Tests\TestCase;

class PhrealestateRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\PhrealestateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhrealestateRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $phrealestates = factory(Phrealestate::class, 3)->create();
        $phrealestateIds = $phrealestates->pluck('id')->toArray();

        /** @var  \App\Repositories\PhrealestateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhrealestateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $phrealestatesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Phrealestate::class, $phrealestatesCheck[0]);

        $phrealestatesCheck = $repository->getByIds($phrealestateIds);
        $this->assertEquals(3, count($phrealestatesCheck));
    }

    public function testFind()
    {
        $phrealestates = factory(Phrealestate::class, 3)->create();
        $phrealestateIds = $phrealestates->pluck('id')->toArray();

        /** @var  \App\Repositories\PhrealestateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhrealestateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $phrealestateCheck = $repository->find($phrealestateIds[0]);
        $this->assertEquals($phrealestateIds[0], $phrealestateCheck->id);
    }

    public function testCreate()
    {
        $phrealestateData = factory(Phrealestate::class)->make();

        /** @var  \App\Repositories\PhrealestateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhrealestateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $phrealestateCheck = $repository->create($phrealestateData->toFillableArray());
        $this->assertNotNull($phrealestateCheck);
    }

    public function testUpdate()
    {
        $phrealestateData = factory(Phrealestate::class)->create();

        /** @var  \App\Repositories\PhrealestateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhrealestateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $phrealestateCheck = $repository->update($phrealestateData, $phrealestateData->toFillableArray());
        $this->assertNotNull($phrealestateCheck);
    }

    public function testDelete()
    {
        $phrealestateData = factory(Phrealestate::class)->create();

        /** @var  \App\Repositories\PhrealestateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PhrealestateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($phrealestateData);

        $phrealestateCheck = $repository->find($phrealestateData->id);
        $this->assertNull($phrealestateCheck);
    }

}
