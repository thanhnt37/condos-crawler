<?php namespace App\Repositories\Eloquent;

use \App\Repositories\ZipmatchRepositoryInterface;
use \App\Models\Zipmatch;

class ZipmatchRepository extends SingleKeyModelRepository implements ZipmatchRepositoryInterface
{

    public function getBlankModel()
    {
        return new Zipmatch();
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
