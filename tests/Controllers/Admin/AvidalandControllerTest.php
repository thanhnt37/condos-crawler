<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class AvidalandControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\AvidalandController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\AvidalandController::class);
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
        $response = $this->action('GET', 'Admin\AvidalandController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\AvidalandController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $avidaland = factory(\App\Models\Avidaland::class)->make();
        $this->action('POST', 'Admin\AvidalandController@store', [
                '_token' => csrf_token(),
            ] + $avidaland->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $avidaland = factory(\App\Models\Avidaland::class)->create();
        $this->action('GET', 'Admin\AvidalandController@show', [$avidaland->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $avidaland = factory(\App\Models\Avidaland::class)->create();

        $name = $faker->name;
        $id = $avidaland->id;

        $avidaland->name = $name;

        $this->action('PUT', 'Admin\AvidalandController@update', [$id], [
                '_token' => csrf_token(),
            ] + $avidaland->toArray());
        $this->assertResponseStatus(302);

        $newAvidaland = \App\Models\Avidaland::find($id);
        $this->assertEquals($name, $newAvidaland->name);
    }

    public function testDeleteModel()
    {
        $avidaland = factory(\App\Models\Avidaland::class)->create();

        $id = $avidaland->id;

        $this->action('DELETE', 'Admin\AvidalandController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkAvidaland = \App\Models\Avidaland::find($id);
        $this->assertNull($checkAvidaland);
    }

}
