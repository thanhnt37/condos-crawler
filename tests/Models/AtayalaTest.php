<?php namespace Tests\Models;

use App\Models\Atayala;
use Tests\TestCase;

class AtayalaTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Atayala $atayala */
        $atayala = new Atayala();
        $this->assertNotNull($atayala);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Atayala $atayala */
        $atayalaModel = new Atayala();

        $atayalaData = factory(Atayala::class)->make();
        foreach( $atayalaData->toFillableArray() as $key => $value ) {
            $atayalaModel->$key = $value;
        }
        $atayalaModel->save();

        $this->assertNotNull(Atayala::find($atayalaModel->id));
    }

}
