<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\PhrealestateRepositoryInterface;
use App\Http\Requests\Admin\PhrealestateRequest;
use App\Http\Requests\PaginationRequest;

class PhrealestateController extends Controller
{

    /** @var \App\Repositories\PhrealestateRepositoryInterface */
    protected $phrealestateRepository;


    public function __construct(
        PhrealestateRepositoryInterface $phrealestateRepository
    )
    {
        $this->phrealestateRepository = $phrealestateRepository;
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
        $paginate['baseUrl']    = action( 'Admin\PhrealestateController@index' );

        $count = $this->phrealestateRepository->count();
        $phrealestates = $this->phrealestateRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view('pages.admin.' . config('view.admin') . '.phrealestates.index', [
            'phrealestates'    => $phrealestates,
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
        return view('pages.admin.' . config('view.admin') . '.phrealestates.edit', [
            'isNew'     => true,
            'phrealestate' => $this->phrealestateRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(PhrealestateRequest $request)
    {
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions']);

        $phrealestate = $this->phrealestateRepository->create($input);

        if (empty( $phrealestate )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\PhrealestateController@index')
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
        $phrealestate = $this->phrealestateRepository->find($id);
        if (empty( $phrealestate )) {
            abort(404);
        }

        return view('pages.admin.' . config('view.admin') . '.phrealestates.edit', [
            'isNew' => false,
            'phrealestate' => $phrealestate,
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
    public function update($id, PhrealestateRequest $request)
    {
        /** @var \App\Models\Phrealestate $phrealestate */
        $phrealestate = $this->phrealestateRepository->find($id);
        if (empty( $phrealestate )) {
            abort(404);
        }
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions']);
        
        $this->phrealestateRepository->update($phrealestate, $input);

        return redirect()->action('Admin\PhrealestateController@show', [$id])
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
        /** @var \App\Models\Phrealestate $phrealestate */
        $phrealestate = $this->phrealestateRepository->find($id);
        if (empty( $phrealestate )) {
            abort(404);
        }
        $this->phrealestateRepository->delete($phrealestate);

        return redirect()->action('Admin\PhrealestateController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
