<?php namespace Tests\Models;

use App\Models\Propertyasia;
use Tests\TestCase;

class PropertyasiaTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Propertyasia $propertyasia */
        $propertyasia = new Propertyasia();
        $this->assertNotNull($propertyasia);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Propertyasia $propertyasia */
        $propertyasiaModel = new Propertyasia();

        $propertyasiaData = factory(Propertyasia::class)->make();
        foreach( $propertyasiaData->toFillableArray() as $key => $value ) {
            $propertyasiaModel->$key = $value;
        }
        $propertyasiaModel->save();

        $this->assertNotNull(Propertyasia::find($propertyasiaModel->id));
    }

}
