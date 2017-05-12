<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\AtayalaRepositoryInterface;
use App\Http\Requests\Admin\AtayalaRequest;
use App\Http\Requests\PaginationRequest;

class AtayalaController extends Controller
{

    /** @var \App\Repositories\AtayalaRepositoryInterface */
    protected $atayalaRepository;


    public function __construct(
        AtayalaRepositoryInterface $atayalaRepository
    )
    {
        $this->atayalaRepository = $atayalaRepository;
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
        $paginate['baseUrl']    = action( 'Admin\AtayalaController@index' );

        $count = $this->atayalaRepository->count();
        $atayalas = $this->atayalaRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view('pages.admin.' . config('view.admin') . '.atayalas.index', [
            'atayalas'    => $atayalas,
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
        return view('pages.admin.' . config('view.admin') . '.atayalas.edit', [
            'isNew'     => true,
            'atayala' => $this->atayalaRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(AtayalaRequest $request)
    {
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions']);

        $atayala = $this->atayalaRepository->create($input);

        if (empty( $atayala )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\AtayalaController@index')
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
        $atayala = $this->atayalaRepository->find($id);
        if (empty( $atayala )) {
            abort(404);
        }

        return view('pages.admin.' . config('view.admin') . '.atayalas.edit', [
            'isNew' => false,
            'atayala' => $atayala,
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
    public function update($id, AtayalaRequest $request)
    {
        /** @var \App\Models\Atayala $atayala */
        $atayala = $this->atayalaRepository->find($id);
        if (empty( $atayala )) {
            abort(404);
        }
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions']);
        
        $this->atayalaRepository->update($atayala, $input);

        return redirect()->action('Admin\AtayalaController@show', [$id])
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
        /** @var \App\Models\Atayala $atayala */
        $atayala = $this->atayalaRepository->find($id);
        if (empty( $atayala )) {
            abort(404);
        }
        $this->atayalaRepository->delete($atayala);

        return redirect()->action('Admin\AtayalaController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
