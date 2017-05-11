<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class PropertyasiaControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\PropertyasiaController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\PropertyasiaController::class);
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
        $response = $this->action('GET', 'Admin\PropertyasiaController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\PropertyasiaController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $propertyasia = factory(\App\Models\Propertyasia::class)->make();
        $this->action('POST', 'Admin\PropertyasiaController@store', [
                '_token' => csrf_token(),
            ] + $propertyasia->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $propertyasia = factory(\App\Models\Propertyasia::class)->create();
        $this->action('GET', 'Admin\PropertyasiaController@show', [$propertyasia->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $propertyasia = factory(\App\Models\Propertyasia::class)->create();

        $name = $faker->name;
        $id = $propertyasia->id;

        $propertyasia->name = $name;

        $this->action('PUT', 'Admin\PropertyasiaController@update', [$id], [
                '_token' => csrf_token(),
            ] + $propertyasia->toArray());
        $this->assertResponseStatus(302);

        $newPropertyasia = \App\Models\Propertyasia::find($id);
        $this->assertEquals($name, $newPropertyasia->name);
    }

    public function testDeleteModel()
    {
        $propertyasia = factory(\App\Models\Propertyasia::class)->create();

        $id = $propertyasia->id;

        $this->action('DELETE', 'Admin\PropertyasiaController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkPropertyasia = \App\Models\Propertyasia::find($id);
        $this->assertNull($checkPropertyasia);
    }

}
