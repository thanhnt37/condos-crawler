<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\AtayalaRepositoryInterface;

class AtayalaRequest extends BaseRequest
{

    /** @var \App\Repositories\AtayalaRepositoryInterface */
    protected $atayalaRepository;

    public function __construct(AtayalaRepositoryInterface $atayalaRepository)
    {
        $this->atayalaRepository = $atayalaRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->atayalaRepository->rules();
    }

    public function messages()
    {
        return $this->atayalaRepository->messages();
    }

}
