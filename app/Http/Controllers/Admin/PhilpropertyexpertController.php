<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\PhilpropertyexpertRepositoryInterface;
use App\Http\Requests\Admin\PhilpropertyexpertRequest;
use App\Http\Requests\PaginationRequest;

class PhilpropertyexpertController extends Controller
{

    /** @var \App\Repositories\PhilpropertyexpertRepositoryInterface */
    protected $philpropertyexpertRepository;


    public function __construct(
        PhilpropertyexpertRepositoryInterface $philpropertyexpertRepository
    )
    {
        $this->philpropertyexpertRepository = $philpropertyexpertRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest $request
     * @return \Response
     */
    public function index(PaginationRequest $request)
    {
        $paginate['offset']     = $request->offset();
        $paginate['limit']      = $request->limit();
        $paginate['order']      = $request->order();
        $paginate['direction']  = $request->direction();
        $paginate['baseUrl']    = action( 'Admin\PhilpropertyexpertController@index' );

        $count = $this->philpropertyexpertRepository->count();
        $philpropertyexperts = $this->philpropertyexpertRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view('pages.admin.' . config('view.admin') . '.philpropertyexperts.index', [
            'philpropertyexperts'    => $philpropertyexperts,
            'count'         => $count,
            'paginate'      => $paginate,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.' . config('view.admin') . '.philpropertyexperts.edit', [
            'isNew'     => true,
            'philpropertyexpert' => $this->philpropertyexpertRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(PhilpropertyexpertRequest $request)
    {
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $philpropertyexpert = $this->philpropertyexpertRepository->create($input);

        if (empty( $philpropertyexpert )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\PhilpropertyexpertController@index')
            ->with('message-success', trans('admin.messages.general.create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Response
     */
    public function show($id)
    {
        $philpropertyexpert = $this->philpropertyexpertRepository->find($id);
        if (empty( $philpropertyexpert )) {
            abort(404);
        }

        return view('pages.admin.' . config('view.admin') . '.philpropertyexperts.edit', [
            'isNew' => false,
            'philpropertyexpert' => $philpropertyexpert,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param      $request
     * @return \Response
     */
    public function update($id, PhilpropertyexpertRequest $request)
    {
        /** @var \App\Models\Philpropertyexpert $philpropertyexpert */
        $philpropertyexpert = $this->philpropertyexpertRepository->find($id);
        if (empty( $philpropertyexpert )) {
            abort(404);
        }
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->philpropertyexpertRepository->update($philpropertyexpert, $input);

        return redirect()->action('Admin\PhilpropertyexpertController@show', [$id])
                    ->with('message-success', trans('admin.messages.general.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Philpropertyexpert $philpropertyexpert */
        $philpropertyexpert = $this->philpropertyexpertRepository->find($id);
        if (empty( $philpropertyexpert )) {
            abort(404);
        }
        $this->philpropertyexpertRepository->delete($philpropertyexpert);

        return redirect()->action('Admin\PhilpropertyexpertController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
