<?php namespace Tests\Models;

use App\Models\Condominiumsmanila;
use Tests\TestCase;

class CondominiumsmanilaTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Condominiumsmanila $condominiumsmanila */
        $condominiumsmanila = new Condominiumsmanila();
        $this->assertNotNull($condominiumsmanila);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Condominiumsmanila $condominiumsmanila */
        $condominiumsmanilaModel = new Condominiumsmanila();

        $condominiumsmanilaData = factory(Condominiumsmanila::class)->make();
        foreach( $condominiumsmanilaData->toFillableArray() as $key => $value ) {
            $condominiumsmanilaModel->$key = $value;
        }
        $condominiumsmanilaModel->save();

        $this->assertNotNull(Condominiumsmanila::find($condominiumsmanilaModel->id));
    }

}
