<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\ZipmatchRepositoryInterface;

class ZipmatchRequest extends BaseRequest
{

    /** @var \App\Repositories\ZipmatchRepositoryInterface */
    protected $zipmatchRepository;

    public function __construct(ZipmatchRepositoryInterface $zipmatchRepository)
    {
        $this->zipmatchRepository = $zipmatchRepository;
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
        return $this->zipmatchRepository->rules();
    }

    public function messages()
    {
        return $this->zipmatchRepository->messages();
    }

}
