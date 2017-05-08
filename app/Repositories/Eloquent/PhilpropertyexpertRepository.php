<?php namespace App\Repositories\Eloquent;

use \App\Repositories\PhilpropertyexpertRepositoryInterface;
use \App\Models\Philpropertyexpert;

class PhilpropertyexpertRepository extends SingleKeyModelRepository implements PhilpropertyexpertRepositoryInterface
{

    public function getBlankModel()
    {
        return new Philpropertyexpert();
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
