<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class AtayalaControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\AtayalaController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\AtayalaController::class);
        $this->assertNotNull($controller);
    }

    public function setUp()
    {
        parent::setUp();
        $authUser = \App\Models\AdminUser::first();
        $this->be($authUser, 'admins');
    }

    public function testGetList()
    {
        $response = $this->action('GET', 'Admin\AtayalaController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\AtayalaController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $atayala = factory(\App\Models\Atayala::class)->make();
        $this->action('POST', 'Admin\AtayalaController@store', [
                '_token' => csrf_token(),
            ] + $atayala->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $atayala = factory(\App\Models\Atayala::class)->create();
        $this->action('GET', 'Admin\AtayalaController@show', [$atayala->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $atayala = factory(\App\Models\Atayala::class)->create();

        $name = $faker->name;
        $id = $atayala->id;

        $atayala->name = $name;

        $this->action('PUT', 'Admin\AtayalaController@update', [$id], [
                '_token' => csrf_token(),
            ] + $atayala->toArray());
        $this->assertResponseStatus(302);

        $newAtayala = \App\Models\Atayala::find($id);
        $this->assertEquals($name, $newAtayala->name);
    }

    public function testDeleteModel()
    {
        $atayala = factory(\App\Models\Atayala::class)->create();

        $id = $atayala->id;

        $this->action('DELETE', 'Admin\AtayalaController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkAtayala = \App\Models\Atayala::find($id);
        $this->assertNull($checkAtayala);
    }

}
