<?php namespace App\Repositories\Eloquent;

use \App\Repositories\PhrealestateRepositoryInterface;
use \App\Models\Phrealestate;

class PhrealestateRepository extends SingleKeyModelRepository implements PhrealestateRepositoryInterface
{

    public function getBlankModel()
    {
        return new Phrealestate();
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
