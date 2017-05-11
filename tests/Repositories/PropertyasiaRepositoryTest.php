<?php namespace Tests\Repositories;

use App\Models\Propertyasia;
use Tests\TestCase;

class PropertyasiaRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\PropertyasiaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PropertyasiaRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $propertyasia = factory(Propertyasia::class, 3)->create();
        $propertyasiaIds = $propertyasia->pluck('id')->toArray();

        /** @var  \App\Repositories\PropertyasiaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PropertyasiaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $propertyasiaCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Propertyasia::class, $propertyasiaCheck[0]);

        $propertyasiaCheck = $repository->getByIds($propertyasiaIds);
        $this->assertEquals(3, count($propertyasiaCheck));
    }

    public function testFind()
    {
        $propertyasia = factory(Propertyasia::class, 3)->create();
        $propertyasiaIds = $propertyasia->pluck('id')->toArray();

        /** @var  \App\Repositories\PropertyasiaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PropertyasiaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $propertyasiaCheck = $repository->find($propertyasiaIds[0]);
        $this->assertEquals($propertyasiaIds[0], $propertyasiaCheck->id);
    }

    public function testCreate()
    {
        $propertyasiaData = factory(Propertyasia::class)->make();

        /** @var  \App\Repositories\PropertyasiaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PropertyasiaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $propertyasiaCheck = $repository->create($propertyasiaData->toFillableArray());
        $this->assertNotNull($propertyasiaCheck);
    }

    public function testUpdate()
    {
        $propertyasiaData = factory(Propertyasia::class)->create();

        /** @var  \App\Repositories\PropertyasiaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PropertyasiaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $propertyasiaCheck = $repository->update($propertyasiaData, $propertyasiaData->toFillableArray());
        $this->assertNotNull($propertyasiaCheck);
    }

    public function testDelete()
    {
        $propertyasiaData = factory(Propertyasia::class)->create();

        /** @var  \App\Repositories\PropertyasiaRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PropertyasiaRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($propertyasiaData);

        $propertyasiaCheck = $repository->find($propertyasiaData->id);
        $this->assertNull($propertyasiaCheck);
    }

}
