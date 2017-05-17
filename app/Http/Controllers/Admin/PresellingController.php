<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\PresellingRepositoryInterface;
use App\Http\Requests\Admin\PresellingRequest;
use App\Http\Requests\PaginationRequest;

class PresellingController extends Controller
{

    /** @var \App\Repositories\PresellingRepositoryInterface */
    protected $presellingRepository;


    public function __construct(
        PresellingRepositoryInterface $presellingRepository
    )
    {
        $this->presellingRepository = $presellingRepository;
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
        $paginate['baseUrl']    = action( 'Admin\PresellingController@index' );

        $count = $this->presellingRepository->count();
        $presellings = $this->presellingRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view('pages.admin.' . config('view.admin') . '.presellings.index', [
            'presellings'    => $presellings,
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
        return view('pages.admin.' . config('view.admin') . '.presellings.edit', [
            'isNew'     => true,
            'preselling' => $this->presellingRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(PresellingRequest $request)
    {
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions','original_url']);

        $preselling = $this->presellingRepository->create($input);

        if (empty( $preselling )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\PresellingController@index')
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
        $preselling = $this->presellingRepository->find($id);
        if (empty( $preselling )) {
            abort(404);
        }

        return view('pages.admin.' . config('view.admin') . '.presellings.edit', [
            'isNew' => false,
            'preselling' => $preselling,
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
    public function update($id, PresellingRequest $request)
    {
        /** @var \App\Models\Preselling $preselling */
        $preselling = $this->presellingRepository->find($id);
        if (empty( $preselling )) {
            abort(404);
        }
        $input = $request->only(['title','postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions','original_url']);
        
        $this->presellingRepository->update($preselling, $input);

        return redirect()->action('Admin\PresellingController@show', [$id])
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
        /** @var \App\Models\Preselling $preselling */
        $preselling = $this->presellingRepository->find($id);
        if (empty( $preselling )) {
            abort(404);
        }
        $this->presellingRepository->delete($preselling);

        return redirect()->action('Admin\PresellingController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
