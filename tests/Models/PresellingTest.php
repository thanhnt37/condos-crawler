<?php namespace Tests\Models;

use App\Models\Preselling;
use Tests\TestCase;

class PresellingTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Preselling $preselling */
        $preselling = new Preselling();
        $this->assertNotNull($preselling);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Preselling $preselling */
        $presellingModel = new Preselling();

        $presellingData = factory(Preselling::class)->make();
        foreach( $presellingData->toFillableArray() as $key => $value ) {
            $presellingModel->$key = $value;
        }
        $presellingModel->save();

        $this->assertNotNull(Preselling::find($presellingModel->id));
    }

}
