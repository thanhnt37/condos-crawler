<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class PhrealestateControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\PhrealestateController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\PhrealestateController::class);
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
        $response = $this->action('GET', 'Admin\PhrealestateController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\PhrealestateController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $phrealestate = factory(\App\Models\Phrealestate::class)->make();
        $this->action('POST', 'Admin\PhrealestateController@store', [
                '_token' => csrf_token(),
            ] + $phrealestate->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $phrealestate = factory(\App\Models\Phrealestate::class)->create();
        $this->action('GET', 'Admin\PhrealestateController@show', [$phrealestate->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $phrealestate = factory(\App\Models\Phrealestate::class)->create();

        $name = $faker->name;
        $id = $phrealestate->id;

        $phrealestate->name = $name;

        $this->action('PUT', 'Admin\PhrealestateController@update', [$id], [
                '_token' => csrf_token(),
            ] + $phrealestate->toArray());
        $this->assertResponseStatus(302);

        $newPhrealestate = \App\Models\Phrealestate::find($id);
        $this->assertEquals($name, $newPhrealestate->name);
    }

    public function testDeleteModel()
    {
        $phrealestate = factory(\App\Models\Phrealestate::class)->create();

        $id = $phrealestate->id;

        $this->action('DELETE', 'Admin\PhrealestateController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkPhrealestate = \App\Models\Phrealestate::find($id);
        $this->assertNull($checkPhrealestate);
    }

}
