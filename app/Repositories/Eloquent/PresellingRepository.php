<?php namespace App\Repositories\Eloquent;

use \App\Repositories\PresellingRepositoryInterface;
use \App\Models\Preselling;

class PresellingRepository extends SingleKeyModelRepository implements PresellingRepositoryInterface
{

    public function getBlankModel()
    {
        return new Preselling();
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
