<?php namespace Tests\Models;

use App\Models\Philpropertyexpert;
use Tests\TestCase;

class PhilpropertyexpertTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Philpropertyexpert $philpropertyexpert */
        $philpropertyexpert = new Philpropertyexpert();
        $this->assertNotNull($philpropertyexpert);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Philpropertyexpert $philpropertyexpert */
        $philpropertyexpertModel = new Philpropertyexpert();

        $philpropertyexpertData = factory(Philpropertyexpert::class)->make();
        foreach( $philpropertyexpertData->toFillableArray() as $key => $value ) {
            $philpropertyexpertModel->$key = $value;
        }
        $philpropertyexpertModel->save();

        $this->assertNotNull(Philpropertyexpert::find($philpropertyexpertModel->id));
    }

}
