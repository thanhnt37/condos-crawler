<?php namespace Tests\Models;

use App\Models\Avidaland;
use Tests\TestCase;

class AvidalandTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Avidaland $avidaland */
        $avidaland = new Avidaland();
        $this->assertNotNull($avidaland);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Avidaland $avidaland */
        $avidalandModel = new Avidaland();

        $avidalandData = factory(Avidaland::class)->make();
        foreach( $avidalandData->toFillableArray() as $key => $value ) {
            $avidalandModel->$key = $value;
        }
        $avidalandModel->save();

        $this->assertNotNull(Avidaland::find($avidalandModel->id));
    }

}
