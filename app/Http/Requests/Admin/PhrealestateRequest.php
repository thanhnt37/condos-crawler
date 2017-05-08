<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\PhrealestateRepositoryInterface;

class PhrealestateRequest extends BaseRequest
{

    /** @var \App\Repositories\PhrealestateRepositoryInterface */
    protected $phrealestateRepository;

    public function __construct(PhrealestateRepositoryInterface $phrealestateRepository)
    {
        $this->phrealestateRepository = $phrealestateRepository;
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
        return $this->phrealestateRepository->rules();
    }

    public function messages()
    {
        return $this->phrealestateRepository->messages();
    }

}
