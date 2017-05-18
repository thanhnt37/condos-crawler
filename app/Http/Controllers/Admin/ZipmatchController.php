<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\ZipmatchRepositoryInterface;
use App\Http\Requests\Admin\ZipmatchRequest;
use App\Http\Requests\PaginationRequest;

class ZipmatchController extends Controller
{

    /** @var \App\Repositories\ZipmatchRepositoryInterface */
    protected $zipmatchRepository;


    public function __construct(
        ZipmatchRepositoryInterface $zipmatchRepository
    )
    {
        $this->zipmatchRepository = $zipmatchRepository;
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
        $paginate['baseUrl']    = action( 'Admin\ZipmatchController@index' );

        $count = $this->zipmatchRepository->count();
        $zipmatchs = $this->zipmatchRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view('pages.admin.' . config('view.admin') . '.zipmatches.index', [
            'zipmatchs'    => $zipmatchs,
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
        return view('pages.admin.' . config('view.admin') . '.zipmatches.edit', [
            'isNew'     => true,
            'zipmatch' => $this->zipmatchRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(ZipmatchRequest $request)
    {
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions','original_url']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $zipmatch = $this->zipmatchRepository->create($input);

        if (empty( $zipmatch )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\ZipmatchController@index')
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
        $zipmatch = $this->zipmatchRepository->find($id);
        if (empty( $zipmatch )) {
            abort(404);
        }

        return view('pages.admin.' . config('view.admin') . '.zipmatches.edit', [
            'isNew' => false,
            'zipmatch' => $zipmatch,
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
    public function update($id, ZipmatchRequest $request)
    {
        /** @var \App\Models\Zipmatch $zipmatch */
        $zipmatch = $this->zipmatchRepository->find($id);
        if (empty( $zipmatch )) {
            abort(404);
        }
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions','original_url']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->zipmatchRepository->update($zipmatch, $input);

        return redirect()->action('Admin\ZipmatchController@show', [$id])
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
        /** @var \App\Models\Zipmatch $zipmatch */
        $zipmatch = $this->zipmatchRepository->find($id);
        if (empty( $zipmatch )) {
            abort(404);
        }
        $this->zipmatchRepository->delete($zipmatch);

        return redirect()->action('Admin\ZipmatchController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
