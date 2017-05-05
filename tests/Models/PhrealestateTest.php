<?php namespace Tests\Models;

use App\Models\Phrealestate;
use Tests\TestCase;

class PhrealestateTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Phrealestate $phrealestate */
        $phrealestate = new Phrealestate();
        $this->assertNotNull($phrealestate);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Phrealestate $phrealestate */
        $phrealestateModel = new Phrealestate();

        $phrealestateData = factory(Phrealestate::class)->make();
        foreach( $phrealestateData->toFillableArray() as $key => $value ) {
            $phrealestateModel->$key = $value;
        }
        $phrealestateModel->save();

        $this->assertNotNull(Phrealestate::find($phrealestateModel->id));
    }

}
