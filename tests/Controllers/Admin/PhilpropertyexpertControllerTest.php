<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class PhilpropertyexpertControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\PhilpropertyexpertController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\PhilpropertyexpertController::class);
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
        $response = $this->action('GET', 'Admin\PhilpropertyexpertController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\PhilpropertyexpertController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $philpropertyexpert = factory(\App\Models\Philpropertyexpert::class)->make();
        $this->action('POST', 'Admin\PhilpropertyexpertController@store', [
                '_token' => csrf_token(),
            ] + $philpropertyexpert->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $philpropertyexpert = factory(\App\Models\Philpropertyexpert::class)->create();
        $this->action('GET', 'Admin\PhilpropertyexpertController@show', [$philpropertyexpert->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $philpropertyexpert = factory(\App\Models\Philpropertyexpert::class)->create();

        $name = $faker->name;
        $id = $philpropertyexpert->id;

        $philpropertyexpert->name = $name;

        $this->action('PUT', 'Admin\PhilpropertyexpertController@update', [$id], [
                '_token' => csrf_token(),
            ] + $philpropertyexpert->toArray());
        $this->assertResponseStatus(302);

        $newPhilpropertyexpert = \App\Models\Philpropertyexpert::find($id);
        $this->assertEquals($name, $newPhilpropertyexpert->name);
    }

    public function testDeleteModel()
    {
        $philpropertyexpert = factory(\App\Models\Philpropertyexpert::class)->create();

        $id = $philpropertyexpert->id;

        $this->action('DELETE', 'Admin\PhilpropertyexpertController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkPhilpropertyexpert = \App\Models\Philpropertyexpert::find($id);
        $this->assertNull($checkPhilpropertyexpert);
    }

}
