<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\AvidalandRepositoryInterface;

class AvidalandRequest extends BaseRequest
{

    /** @var \App\Repositories\AvidalandRepositoryInterface */
    protected $avidalandRepository;

    public function __construct(AvidalandRepositoryInterface $avidalandRepository)
    {
        $this->avidalandRepository = $avidalandRepository;
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
        return $this->avidalandRepository->rules();
    }

    public function messages()
    {
        return $this->avidalandRepository->messages();
    }

}
