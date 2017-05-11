<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\PropertyasiaRepositoryInterface;

class PropertyasiaRequest extends BaseRequest
{

    /** @var \App\Repositories\PropertyasiaRepositoryInterface */
    protected $propertyasiaRepository;

    public function __construct(PropertyasiaRepositoryInterface $propertyasiaRepository)
    {
        $this->propertyasiaRepository = $propertyasiaRepository;
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
        return $this->propertyasiaRepository->rules();
    }

    public function messages()
    {
        return $this->propertyasiaRepository->messages();
    }

}
