<?php namespace App\Repositories\Eloquent;

use \App\Repositories\PropertyasiaRepositoryInterface;
use \App\Models\Propertyasia;

class PropertyasiaRepository extends SingleKeyModelRepository implements PropertyasiaRepositoryInterface
{

    public function getBlankModel()
    {
        return new Propertyasia();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}
