<?php namespace App\Repositories\Eloquent;

use \App\Repositories\CondominiumsmanilaRepositoryInterface;
use \App\Models\Condominiumsmanila;

class CondominiumsmanilaRepository extends SingleKeyModelRepository implements CondominiumsmanilaRepositoryInterface
{

    public function getBlankModel()
    {
        return new Condominiumsmanila();
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
