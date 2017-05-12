<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\AvidalandRepositoryInterface;
use App\Http\Requests\Admin\AvidalandRequest;
use App\Http\Requests\PaginationRequest;

class AvidalandController extends Controller
{

    /** @var \App\Repositories\AvidalandRepositoryInterface */
    protected $avidalandRepository;


    public function __construct(
        AvidalandRepositoryInterface $avidalandRepository
    )
    {
        $this->avidalandRepository = $avidalandRepository;
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
        $paginate['baseUrl']    = action( 'Admin\AvidalandController@index' );

        $count = $this->avidalandRepository->count();
        $avidalands = $this->avidalandRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view('pages.admin.' . config('view.admin') . '.avidalands.index', [
            'avidalands'    => $avidalands,
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
        return view('pages.admin.' . config('view.admin') . '.avidalands.edit', [
            'isNew'     => true,
            'avidaland' => $this->avidalandRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(AvidalandRequest $request)
    {
        $input = $request->only(['title', 'postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions']);

        $avidaland = $this->avidalandRepository->create($input);

        if (empty( $avidaland )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\AvidalandController@index')
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
        $avidaland = $this->avidalandRepository->find($id);
        if (empty( $avidaland )) {
            abort(404);
        }

        return view('pages.admin.' . config('view.admin') . '.avidalands.edit', [
            'isNew' => false,
            'avidaland' => $avidaland,
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
    public function update($id, AvidalandRequest $request)
    {
        /** @var \App\Models\Avidaland $avidaland */
        $avidaland = $this->avidalandRepository->find($id);
        if (empty( $avidaland )) {
            abort(404);
        }
        $input = $request->only(['title', 'postal_code','country','province','city','address','building_type','latitude','longitude','completion_year','number_floor','number_unit','developer_name','facilities','unit_size','condo_url','developer_url','image_url','descriptions']);

        $this->avidalandRepository->update($avidaland, $input);

        return redirect()->action('Admin\AvidalandController@show', [$id])
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
        /** @var \App\Models\Avidaland $avidaland */
        $avidaland = $this->avidalandRepository->find($id);
        if (empty( $avidaland )) {
            abort(404);
        }
        $this->avidalandRepository->delete($avidaland);

        return redirect()->action('Admin\AvidalandController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
