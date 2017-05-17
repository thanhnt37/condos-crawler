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

    public function getWithFilter($filter, $order, $direction, $offset, $limit)
    {
        $model = $this->getBlankModel();

        $keyword = isset($filter['keyword']) ? $filter['keyword'] : '';
        $model = $model->where(function ($subquery) use ($keyword) {
            $subquery->where('title', 'like', '%'.$keyword.'%');
        });

        return $model->orderBy($order, $direction)->skip($offset)->take($limit)->get();
    }

    public function countWithFilter($filter)
    {
        $model = $this->getBlankModel();

        $keyword = isset($filter['keyword']) ? $filter['keyword'] : '';
        $model = $model->where(function ($subquery) use ($keyword) {
            $subquery->where('title', 'like', '%'.$keyword.'%');
        });

        return $model->count();
    }
}
