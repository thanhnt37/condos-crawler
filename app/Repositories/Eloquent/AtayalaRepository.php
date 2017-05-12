<?php namespace App\Repositories\Eloquent;

use \App\Repositories\AtayalaRepositoryInterface;
use \App\Models\Atayala;

class AtayalaRepository extends SingleKeyModelRepository implements AtayalaRepositoryInterface
{

    public function getBlankModel()
    {
        return new Atayala();
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
