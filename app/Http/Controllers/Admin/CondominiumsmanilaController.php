<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\CondominiumsmanilaRepositoryInterface;
use App\Http\Requests\Admin\CondominiumsmanilaRequest;
use App\Http\Requests\PaginationRequest;

class CondominiumsmanilaController extends Controller
{

    /** @var \App\Repositories\CondominiumsmanilaRepositoryInterface */
    protected $condominiumsmanilaRepository;


    public function __construct(
        CondominiumsmanilaRepositoryInterface $condominiumsmanilaRepository
    )
    {
        $this->condominiumsmanilaRepository = $condominiumsmanilaRepository;
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
        $paginate['baseUrl']    = action( 'Admin\CondominiumsmanilaController@index' );

        $count = $this->condominiumsmanilaRepository->count();
        $condominiumsmanilas = $this->condominiumsmanilaRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view('pages.admin.' . config('view.admin') . '.condominiumsmanilas.index', [
            'condominiumsmanilas'    => $condominiumsmanilas,
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
        return view('pages.admin.' . config('view.admin') . '.condominiumsmanilas.edit', [
            'isNew'     => true,
            'condominiumsmanila' => $this->condominiumsmanilaRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(CondominiumsmanilaRequest $request)
    {
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $condominiumsmanila = $this->condominiumsmanilaRepository->create($input);

        if (empty( $condominiumsmanila )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\CondominiumsmanilaController@index')
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
        $condominiumsmanila = $this->condominiumsmanilaRepository->find($id);
        if (empty( $condominiumsmanila )) {
            abort(404);
        }

        return view('pages.admin.' . config('view.admin') . '.condominiumsmanilas.edit', [
            'isNew' => false,
            'condominiumsmanila' => $condominiumsmanila,
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
    public function update($id, CondominiumsmanilaRequest $request)
    {
        /** @var \App\Models\Condominiumsmanila $condominiumsmanila */
        $condominiumsmanila = $this->condominiumsmanilaRepository->find($id);
        if (empty( $condominiumsmanila )) {
            abort(404);
        }
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->condominiumsmanilaRepository->update($condominiumsmanila, $input);

        return redirect()->action('Admin\CondominiumsmanilaController@show', [$id])
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
        /** @var \App\Models\Condominiumsmanila $condominiumsmanila */
        $condominiumsmanila = $this->condominiumsmanilaRepository->find($id);
        if (empty( $condominiumsmanila )) {
            abort(404);
        }
        $this->condominiumsmanilaRepository->delete($condominiumsmanila);

        return redirect()->action('Admin\CondominiumsmanilaController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
