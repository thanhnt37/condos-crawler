<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\PropertyasiaRepositoryInterface;
use App\Http\Requests\Admin\PropertyasiaRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\PhrealestateRepositoryInterface;

class PropertyasiaController extends Controller
{

    /** @var \App\Repositories\PropertyasiaRepositoryInterface */
    protected $propertyasiaRepository;

    /** @var \App\Repositories\PhrealestateRepositoryInterface */
    protected $phrealestateRepository;

    public function __construct(
        PropertyasiaRepositoryInterface $propertyasiaRepository,
        PhrealestateRepositoryInterface $phrealestateRepository
    )
    {
        $this->propertyasiaRepository   = $propertyasiaRepository;
        $this->phrealestateRepository   = $phrealestateRepository;
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
        $paginate['baseUrl']    = action( 'Admin\PropertyasiaController@index' );
        $filter[ 'keyword' ]    = $request->get( 'l_search_keyword', '' );

        $count = $this->propertyasiaRepository->count();
        $propertyasias = $this->propertyasiaRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        $propertyasias = $this->propertyasiaRepository->getWithFilter(
            $filter,
            $paginate[ 'order' ],
            $paginate[ 'direction' ],
            $paginate[ 'offset' ],
            $paginate[ 'limit' ]
        );
        $count = $this->propertyasiaRepository->countWithFilter( $filter );

        return view('pages.admin.' . config('view.admin') . '.propertyasia.index', [
            'propertyasias'    => $propertyasias,
            'count'         => $count,
            'paginate'      => $paginate,
            'keyword'       => $filter[ 'keyword' ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.' . config('view.admin') . '.propertyasia.edit', [
            'isNew'     => true,
            'propertyasia' => $this->propertyasiaRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(PropertyasiaRequest $request)
    {
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions']);

        $propertyasia = $this->propertyasiaRepository->create($input);

        if (empty( $propertyasia )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\PropertyasiaController@index')
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
        $propertyasia = $this->propertyasiaRepository->find($id);
        if (empty( $propertyasia )) {
            abort(404);
        }

        return view('pages.admin.' . config('view.admin') . '.propertyasia.edit', [
            'isNew' => false,
            'propertyasia' => $propertyasia,
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
    public function update($id, PropertyasiaRequest $request)
    {
        /** @var \App\Models\Propertyasia $propertyasia */
        $propertyasia = $this->propertyasiaRepository->find($id);
        if (empty( $propertyasia )) {
            abort(404);
        }
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions']);
        
        $this->propertyasiaRepository->update($propertyasia, $input);

        return redirect()->action('Admin\PropertyasiaController@show', [$id])
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
        /** @var \App\Models\Propertyasia $propertyasia */
        $propertyasia = $this->propertyasiaRepository->find($id);
        if (empty( $propertyasia )) {
            abort(404);
        }
        $this->propertyasiaRepository->delete($propertyasia);

        return redirect()->action('Admin\PropertyasiaController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
