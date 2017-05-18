<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class ZipmatchControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\ZipmatchController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\ZipmatchController::class);
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
        $response = $this->action('GET', 'Admin\ZipmatchController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\ZipmatchController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $zipmatch = factory(\App\Models\Zipmatch::class)->make();
        $this->action('POST', 'Admin\ZipmatchController@store', [
                '_token' => csrf_token(),
            ] + $zipmatch->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $zipmatch = factory(\App\Models\Zipmatch::class)->create();
        $this->action('GET', 'Admin\ZipmatchController@show', [$zipmatch->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $zipmatch = factory(\App\Models\Zipmatch::class)->create();

        $name = $faker->name;
        $id = $zipmatch->id;

        $zipmatch->name = $name;

        $this->action('PUT', 'Admin\ZipmatchController@update', [$id], [
                '_token' => csrf_token(),
            ] + $zipmatch->toArray());
        $this->assertResponseStatus(302);

        $newZipmatch = \App\Models\Zipmatch::find($id);
        $this->assertEquals($name, $newZipmatch->name);
    }

    public function testDeleteModel()
    {
        $zipmatch = factory(\App\Models\Zipmatch::class)->create();

        $id = $zipmatch->id;

        $this->action('DELETE', 'Admin\ZipmatchController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkZipmatch = \App\Models\Zipmatch::find($id);
        $this->assertNull($checkZipmatch);
    }

}
