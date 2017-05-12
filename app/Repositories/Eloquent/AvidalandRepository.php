<?php namespace App\Repositories\Eloquent;

use \App\Repositories\AvidalandRepositoryInterface;
use \App\Models\Avidaland;

class AvidalandRepository extends SingleKeyModelRepository implements AvidalandRepositoryInterface
{

    public function getBlankModel()
    {
        return new Avidaland();
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
