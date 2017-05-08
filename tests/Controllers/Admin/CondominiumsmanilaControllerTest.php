<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class CondominiumsmanilaControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\CondominiumsmanilaController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\CondominiumsmanilaController::class);
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
        $response = $this->action('GET', 'Admin\CondominiumsmanilaController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\CondominiumsmanilaController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $condominiumsmanila = factory(\App\Models\Condominiumsmanila::class)->make();
        $this->action('POST', 'Admin\CondominiumsmanilaController@store', [
                '_token' => csrf_token(),
            ] + $condominiumsmanila->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $condominiumsmanila = factory(\App\Models\Condominiumsmanila::class)->create();
        $this->action('GET', 'Admin\CondominiumsmanilaController@show', [$condominiumsmanila->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $condominiumsmanila = factory(\App\Models\Condominiumsmanila::class)->create();

        $name = $faker->name;
        $id = $condominiumsmanila->id;

        $condominiumsmanila->name = $name;

        $this->action('PUT', 'Admin\CondominiumsmanilaController@update', [$id], [
                '_token' => csrf_token(),
            ] + $condominiumsmanila->toArray());
        $this->assertResponseStatus(302);

        $newCondominiumsmanila = \App\Models\Condominiumsmanila::find($id);
        $this->assertEquals($name, $newCondominiumsmanila->name);
    }

    public function testDeleteModel()
    {
        $condominiumsmanila = factory(\App\Models\Condominiumsmanila::class)->create();

        $id = $condominiumsmanila->id;

        $this->action('DELETE', 'Admin\CondominiumsmanilaController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkCondominiumsmanila = \App\Models\Condominiumsmanila::find($id);
        $this->assertNull($checkCondominiumsmanila);
    }

}
