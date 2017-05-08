<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\PhilpropertyexpertRepositoryInterface;

class PhilpropertyexpertRequest extends BaseRequest
{

    /** @var \App\Repositories\PhilpropertyexpertRepositoryInterface */
    protected $philpropertyexpertRepository;

    public function __construct(PhilpropertyexpertRepositoryInterface $philpropertyexpertRepository)
    {
        $this->philpropertyexpertRepository = $philpropertyexpertRepository;
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
        return $this->philpropertyexpertRepository->rules();
    }

    public function messages()
    {
        return $this->philpropertyexpertRepository->messages();
    }

}
