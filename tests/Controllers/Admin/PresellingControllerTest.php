<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class PresellingControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\PresellingController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\PresellingController::class);
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
        $response = $this->action('GET', 'Admin\PresellingController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\PresellingController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $preselling = factory(\App\Models\Preselling::class)->make();
        $this->action('POST', 'Admin\PresellingController@store', [
                '_token' => csrf_token(),
            ] + $preselling->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $preselling = factory(\App\Models\Preselling::class)->create();
        $this->action('GET', 'Admin\PresellingController@show', [$preselling->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $preselling = factory(\App\Models\Preselling::class)->create();

        $name = $faker->name;
        $id = $preselling->id;

        $preselling->name = $name;

        $this->action('PUT', 'Admin\PresellingController@update', [$id], [
                '_token' => csrf_token(),
            ] + $preselling->toArray());
        $this->assertResponseStatus(302);

        $newPreselling = \App\Models\Preselling::find($id);
        $this->assertEquals($name, $newPreselling->name);
    }

    public function testDeleteModel()
    {
        $preselling = factory(\App\Models\Preselling::class)->create();

        $id = $preselling->id;

        $this->action('DELETE', 'Admin\PresellingController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkPreselling = \App\Models\Preselling::find($id);
        $this->assertNull($checkPreselling);
    }

}
