<?php namespace Tests\Models;

use App\Models\Zipmatch;
use Tests\TestCase;

class ZipmatchTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Zipmatch $zipmatch */
        $zipmatch = new Zipmatch();
        $this->assertNotNull($zipmatch);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Zipmatch $zipmatch */
        $zipmatchModel = new Zipmatch();

        $zipmatchData = factory(Zipmatch::class)->make();
        foreach( $zipmatchData->toFillableArray() as $key => $value ) {
            $zipmatchModel->$key = $value;
        }
        $zipmatchModel->save();

        $this->assertNotNull(Zipmatch::find($zipmatchModel->id));
    }

}
