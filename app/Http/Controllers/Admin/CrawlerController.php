<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Production\StringHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use Maatwebsite\Excel\Excel;
use Yangqi\Htmldom\Htmldom;
use App\Repositories\CondominiumsmanilaRepositoryInterface;
use App\Repositories\PhrealestateRepositoryInterface;

class CrawlerController extends Controller
{
    /** @var \App\Repositories\CondominiumsmanilaRepositoryInterface */
    protected $condominiumsmanilaRepository;

    /** @var \App\Repositories\PhrealestateRepositoryInterface */
    protected $phrealestateRepository;

    public function __construct(
        CondominiumsmanilaRepositoryInterface   $condominiumsmanilaRepository,
        PhrealestateRepositoryInterface         $phrealestateRepository
    )
    {
        $this->condominiumsmanilaRepository     = $condominiumsmanilaRepository;
        $this->phrealestateRepository           = $phrealestateRepository;
    }

    public function index()
    {
        return view('pages.admin.' . config('view.admin') . '.crawlers.index', [
        ]);
    }

    public function crawl(BaseRequest $request)
    {
        $url = $request->get('url', '');

        $urls = $this->getListCondominiumsmanila($url);

        $condos = [];
        $condosFields = [];
        foreach ($urls as $key => $url) {
            $condos[$key] = $this->getDetailCondominiumsmanila($url);
            if( count($condosFields) < count($condos[$key]) ) {
                $condosFields = array_keys($condos[$key]);
            }
        }
        $condosFields = array_fill_keys($condosFields, "");

        foreach ($condos as $key => $condo) {
//            $condos[$key] = array_merge($condosFields, $condo);
            $this->condominiumsmanilaRepository->create(
                [
                    'title'           => isset($condo['title']) ? $condo['title'] : 'null',
                    'postal_code'     => null,
                    'country'         => 'philippine',
                    'province'        => null,
                    'city'            => null,
                    'address'         => isset($condo['condo_location']) ? $condo['condo_location'] : null,
                    'building_type'   => isset($condo['type']) ? $condo['type'] : null,
                    'latitude'        => 0,
                    'longitude'       => 0,
                    'completion_year' => null,
                    'number_floor'    => isset($condo['condo_levels']) ? intval($condo['condo_levels']) : null,
                    'number_unit'     => null,
                    'developer_name'  => isset($condo['developer']) ? $condo['developer'] : null,
                    'facilities'      => isset($condo['facilitiesand_services']) ? $condo['facilitiesand_services'] : null,
                    'unit_size'       => isset($condo['available_unit_sizes']) ? $condo['available_unit_sizes'] : null,
                    'condo_url'       => null,
                    'developer_url'   => null,
                ]
            );
        }

        return redirect()
            ->action('Admin\CrawlerController@index')
            ->with(
                'message-success',
                trans('admin.messages.general.create_success')
            );

//        \Excel::create('condominiumsmanila.com', function($excel) use ($condosFields, $condos) {
//
//            $excel->sheet('condominiumsmanila.com', function($sheet) use ($condosFields, $condos) {
//                $sheet->row(1, array_keys($condosFields));
//                $sheet->fromArray($condos);
//            });
//
//        })->export('csv');
    }

    public function phrealestate(BaseRequest $request)
    {
        $url = $request->get('url', '');

        $urls = $this->getListPhrealestate($url);

        foreach ($urls as $key => $url) {
            $condo = $this->getDetailPhrealestate($url);

            $this->phrealestateRepository->create(
                [
                    'title'           => isset($condo['title']) ? $condo['title'] : 'null',
                    'postal_code'     => null,
                    'country'         => 'philippine',
                    'province'        => null,
                    'city'            => null,
                    'address'         => (isset($condo['address']) ? $condo['address'] : null) . isset($condo['location']) ? (' - ' . $condo['location']) : null,
                    'building_type'   => isset($condo['project_type']) ? $condo['project_type'] : null,
                    'latitude'        => 0,
                    'longitude'       => 0,
                    'completion_year' => null,
                    'number_floor'    => null,
                    'number_unit'     => null,
                    'developer_name'  => null,
                    'facilities'      => null,
                    'unit_size'       => isset($condo['units']) ? $condo['units'] : null,
                    'condo_url'       => isset($condo['condos_url']) ? $condo['condos_url'] : null,
                    'developer_url'   => null,
                    'image_url'       => isset($condo['image_url']) ? intval($condo['image_url']) : null,
                    'descriptions'    => isset($condo['descriptions']) ? intval($condo['descriptions']) : null,
                ]
            );
        }

        return redirect()
            ->action('Admin\CrawlerController@index')
            ->with(
                'message-success',
                trans('admin.messages.general.create_success')
            );
    }

    // ------------ Condominiumsmanila ------------
    private function getListCondominiumsmanila($url)
    {
        $dom = new Htmldom($url);
        $elems = $dom->find('a.contentfont');
        $urls = [];
        foreach ( $elems as $elem ) {
            $urls[] = 'https://www.condominiumsmanila.com' . str_replace(' ', '%20', $elem->href);
        }

        return array_unique($urls);
    }

    private function getDetailCondominiumsmanila($url)
    {
        $dom = new Htmldom($url);
        $elems = $dom->find('td.contentfont[style=padding-top:10px]');
        unset($elems[0]);

        $title = $dom->find('span.contentheader');
        $condos['title'] = $title[0]->plaintext;

        foreach ( $elems as $elem ) {
            $key = explode(':', $elem->plaintext)[0];
            $key = \StringHelper::camel2Snake(preg_replace("/[^a-zA-Z0-9]+/", "", $key));
            $condos[$key] = str_replace("\t", "", $elem->plaintext);
            $condos[$key] = substr($condos[$key], strlen($key) + 7, strlen($condos[$key]) - strlen($key) - 2);
        }

        return $condos;
    }
    // ------------ Condominiumsmanila ------------

    // ------------ Phrealestate ------------
    private function getListPhrealestate($url)
    {
        $dom = new Htmldom($url);
        $elems = $dom->find('div.quick-overview a[itemprop=url]');

        $urls = [];
        foreach ( $elems as $elem ) {
            $urls[] = $elem->href;
        }

        return array_unique($urls);
    }

    private function getDetailPhrealestate($url)
    {
        $dom = new Htmldom($url);
        $elems = $dom->find('div.media-body');
        $elems = str_replace("\t", '', $elems[0]->plaintext);

        $title = $dom->find('h1.section-title');
        $condos['title'] = substr($title[0]->plaintext, 3,  strlen($title[0]->plaintext) - 9);

        $descriptions = $dom->find('p[style=text-align: justify;]');
        $condos['descriptions'] = isset($descriptions[0]->plaintext) ? substr($descriptions[0]->plaintext, 3,  strlen($descriptions[0]->plaintext) - 9) : null;

        $condos['image_url'] = $dom->find('img[itemprop=image]')[0]->src;
        foreach ( explode("\r\n", $elems) as $key => $condo ) {
            $property = explode(':', $condo);
            if( count($property) ==2 ) {
                $condos[\StringHelper::camel2Snake($property[0])] = substr(preg_replace('!\s+!', ' ',$property[1]), 1, strlen(preg_replace('!\s+!', ' ',$property[1])) - 2);
            } else {
                $condos['condos_url'] = substr(preg_replace('!\s+!', ' ',$property[0]), 1, strlen(preg_replace('!\s+!', ' ',$property[0])) - 7);
            }
        }

        return $condos;
    }
    // ------------ Phrealestate ------------
}
