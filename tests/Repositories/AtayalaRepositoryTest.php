<?php namespace Tests\Repositories;

use App\Models\Atayala;
use Tests\TestCase;

class AtayalaRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\AtayalaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AtayalaRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $atayalas = factory(Atayala::class, 3)->create();
        $atayalaIds = $atayalas->pluck('id')->toArray();

        /** @var  \App\Repositories\AtayalaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AtayalaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $atayalasCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Atayala::class, $atayalasCheck[0]);

        $atayalasCheck = $repository->getByIds($atayalaIds);
        $this->assertEquals(3, count($atayalasCheck));
    }

    public function testFind()
    {
        $atayalas = factory(Atayala::class, 3)->create();
        $atayalaIds = $atayalas->pluck('id')->toArray();

        /** @var  \App\Repositories\AtayalaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AtayalaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $atayalaCheck = $repository->find($atayalaIds[0]);
        $this->assertEquals($atayalaIds[0], $atayalaCheck->id);
    }

    public function testCreate()
    {
        $atayalaData = factory(Atayala::class)->make();

        /** @var  \App\Repositories\AtayalaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AtayalaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $atayalaCheck = $repository->create($atayalaData->toFillableArray());
        $this->assertNotNull($atayalaCheck);
    }

    public function testUpdate()
    {
        $atayalaData = factory(Atayala::class)->create();

        /** @var  \App\Repositories\AtayalaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AtayalaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $atayalaCheck = $repository->update($atayalaData, $atayalaData->toFillableArray());
        $this->assertNotNull($atayalaCheck);
    }

    public function testDelete()
    {
        $atayalaData = factory(Atayala::class)->create();

        /** @var  \App\Repositories\AtayalaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AtayalaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($atayalaData);

        $atayalaCheck = $repository->find($atayalaData->id);
        $this->assertNull($atayalaCheck);
    }

}
