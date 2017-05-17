<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\PresellingRepositoryInterface;

class PresellingRequest extends BaseRequest
{

    /** @var \App\Repositories\PresellingRepositoryInterface */
    protected $presellingRepository;

    public function __construct(PresellingRepositoryInterface $presellingRepository)
    {
        $this->presellingRepository = $presellingRepository;
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
        return $this->presellingRepository->rules();
    }

    public function messages()
    {
        return $this->presellingRepository->messages();
    }

}
