<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Production\StringHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Excel;
use Yangqi\Htmldom\Htmldom;
use App\Repositories\CondominiumsmanilaRepositoryInterface;
use App\Repositories\PhrealestateRepositoryInterface;
use App\Repositories\PhilpropertyexpertRepositoryInterface;
use App\Repositories\PropertyasiaRepositoryInterface;
use App\Repositories\AvidalandRepositoryInterface;
use App\Repositories\AtayalaRepositoryInterface;

class CrawlerController extends Controller
{
    /** @var \App\Repositories\CondominiumsmanilaRepositoryInterface */
    protected $condominiumsmanilaRepository;

    /** @var \App\Repositories\PhrealestateRepositoryInterface */
    protected $phrealestateRepository;

    /** @var \App\Repositories\PhilpropertyexpertRepositoryInterface */
    protected $philpropertyexpertRepository;

    /** @var \App\Repositories\PropertyasiaRepositoryInterface */
    protected $propertyasiaRepository;

    /** @var \App\Repositories\AvidalandRepositoryInterface */
    protected $avidalandRepository;

    /** @var \App\Repositories\AtayalaRepositoryInterface */
    protected $atayalaRepository;

    public function __construct(
        CondominiumsmanilaRepositoryInterface   $condominiumsmanilaRepository,
        PhrealestateRepositoryInterface         $phrealestateRepository,
        PhilpropertyexpertRepositoryInterface   $philpropertyexpertRepository,
        PropertyasiaRepositoryInterface         $propertyasiaRepository,
        AvidalandRepositoryInterface            $avidalandRepository,
        AtayalaRepositoryInterface              $atayalaRepository
    )
    {
        $this->condominiumsmanilaRepository     = $condominiumsmanilaRepository;
        $this->phrealestateRepository           = $phrealestateRepository;
        $this->philpropertyexpertRepository     = $philpropertyexpertRepository;
        $this->propertyasiaRepository           = $propertyasiaRepository;
        $this->avidalandRepository              = $avidalandRepository;
        $this->atayalaRepository                = $atayalaRepository;
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
            if( !$condo ) {
                continue;
            }

            $this->phrealestateRepository->create(
                [
                    'title'           => isset($condo['title']) ? $condo['title'] : 'null',
                    'postal_code'     => null,
                    'country'         => 'philippine',
                    'province'        => null,
                    'city'            => null,
                    'address'         => (isset($condo['address']) ? $condo['address'] : null) . ((isset($condo['address']) && isset($condo['address'])) ? ', ' : '') . (isset($condo['location']) ? $condo['location'] : null),
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
                    'image_url'       => isset($condo['image_url']) ? $condo['image_url'] : null,
                    'descriptions'    => isset($condo['descriptions']) ? $condo['descriptions'] : null,
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

    public function philpropertyexpert(BaseRequest $request)
    {
        $url = $request->get('url', '');

        $urls = $this->getListPhilpropertyexpert($url);

        foreach ( $urls as $url ) {
            $condo = $this->getDetailPhilpropertyexpert($url);
            if( !$condo ) {
                continue;
            }

            $this->philpropertyexpertRepository->create(
                [
                    'title'           => isset($condo['title']) ? $condo['title'] : 'null',
                    'postal_code'     => null,
                    'country'         => 'philippine',
                    'province'        => null,
                    'city'            => null,
                    'address'         => isset($condo['location']) ? $condo['location'] : null,
                    'building_type'   => isset($condo['property_type']) ? $condo['property_type'] : null,
                    'latitude'        => 0,
                    'longitude'       => 0,
                    'completion_year' => isset($condo['turnover_built']) ? $condo['turnover_built'] : null,
                    'number_floor'    => null,
                    'number_unit'     => null,
                    'developer_name'  => isset($condo['developer']) ? $condo['developer'] : null,
                    'facilities'      => isset($condo['parking']) ? 'parking: ' . $condo['parking'] : null,
                    'unit_size'       => (isset($condo['bedroom']) ? 'bedroom: ' . $condo['bedroom'] : null) . (isset($condo['bathroom']) ? ' | bathroom: ' . $condo['bathroom'] : null),
                    'condo_url'       => null,
                    'developer_url'   => null,
                    'image_url'       => isset($condo['image_url']) ? $condo['image_url'] : null,
                    'descriptions'    => null,
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

    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    function get_url($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
//        $info = curl_getinfo($ch);
//        $logfile = fopen("crawler.log","a");
//        echo fwrite($logfile,'Page ' . $info['url'] . ' fetched in ' . $info['total_time'] . ' seconds. Http status code: ' . $info['http_code'] . "\n");
//        fclose($logfile);
        curl_close($ch);

        return $data;
    }

    public function propertyasia(BaseRequest $request)
    {
        $url = $request->get('url', '');

        $urls = $this->getListPropertyasia($url);
        foreach ( $urls as $url ) {
            $condo = $this->getDetailPropertyasia($url);
            if( !$condo ) {
                continue;
            }

            $this->propertyasiaRepository->create(
                [
                    'title'           => isset($condo['title']) ? $condo['title'] : 'null',
                    'postal_code'     => null,
                    'country'         => 'philippine',
                    'province'        => null,
                    'city'            => null,
                    'address'         => isset($condo['address']) ? $condo['address'] : null,
                    'building_type'   => isset($condo['type']) ? $condo['type'] : null,
                    'latitude'        => isset($condo['latitude']) ? $condo['latitude'] : 0,
                    'longitude'       => isset($condo['longitude']) ? $condo['longitude'] : 0,
                    'completion_year' => isset($condo['available']) ? $condo['available'] : null,
                    'number_floor'    => isset($condo['total_floor']) ? $condo['total_floor'] : null,
                    'number_unit'     => isset($condo['total_units']) ? $condo['total_units'] : null,
                    'facilities'      => isset($condo['facilities']) ? $condo['facilities'] : null,
                    'unit_size'       => isset($condo['unit_types']) ? $condo['unit_types'] : null,
                    'condo_url'       => null,
                    'developer_name'  => null,
                    'developer_url'   => null,
                    'image_url'       => isset($condo['image_url']) ? $condo['image_url'] : null,
                    'descriptions'    => null,
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

    public function avidaland(BaseRequest $request)
    {
        $url = $request->get('url', '');

        $urls = $this->getListAvidaland($url);
        foreach ( $urls as $url ) {
            $condo = $this->getDetailAvidaland($url);
            if( !$condo ) {
                continue;
            }

            $this->avidalandRepository->create(
                [
                    'title'           => isset($condo['title']) ? $condo['title'] : 'null',
                    'postal_code'     => null,
                    'country'         => 'philippine',
                    'province'        => null,
                    'city'            => null,
                    'address'         => isset($condo['location']) ? $condo['location'] : null,
                    'building_type'   => 'Condominium',
                    'latitude'        => isset($condo['latitude']) ? $condo['latitude'] : 0,
                    'longitude'       => isset($condo['longitude']) ? $condo['longitude'] : 0,
                    'completion_year' => isset($condo['complete_year']) ? $condo['complete_year'] : null,
                    'number_floor'    => null,
                    'number_unit'     => null,
                    'facilities'      => null,
                    'unit_size'       => isset($condo['unit_sizes']) ? $condo['unit_sizes'] : null,
                    'condo_url'       => null,
                    'developer_name'  => null,
                    'developer_url'   => null,
                    'image_url'       => isset($condo['image_url']) ? $condo['image_url'] : null,
                    'descriptions'    => null,
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

    public function atayala(BaseRequest $request)
    {
        $url = $request->get('url', '');

        for ($i = 1; $i <= 8; $i++) {
            $page = $url . '?page=' . $i;

            echo $page . '<br>';
            $client = new Client();
            $res = $client->request('GET', $page);

            $condos = json_decode($res->getBody(), true)['results'];

            foreach ( $condos as $condo ) {
                $map = explode( '&', $condo['map_url']);

                $data = [
                    'title'           => isset($condo['project_name']) ? $condo['project_name'] : null,
                    'postal_code'     => null,
                    'country'         => 'philippine',
                    'province'        => null,
                    'city'            => isset($condo['location']) ? $condo['location'] : null,
                    'address'         => isset($condo['address']) ? $condo['address'] : null,
                    'building_type'   => isset($condo['property_types']) ? $condo['property_types'] : null,
                    'latitude'        => (count($map) == 5) ? substr($map[3], 4, strlen($map[3])) : 0,
                    'longitude'       => (count($map) == 5) ? substr($map[4], 5, strlen($map[4])) : 0,
                    'completion_year' => null,
                    'number_floor'    => null,
                    'number_unit'     => null,
                    'facilities'      => null,
                    'unit_size'       => (isset($condo['unit_size_min']) ? $condo['unit_size_min'] . ' sqm' : null) . (isset($condo['unit_size_max']) ? ' ~ ' . $condo['unit_size_max'] . ' sqm' : null),
                    'condo_url'       => null,
                    'developer_name'  => isset($condo['brand']) ? $condo['brand'] : null,
                    'developer_url'   => null,
                    'image_url'       => isset($condo['thumbnail']) ? $condo['thumbnail'] : null,
                    'descriptions'    => null,
                ];

                $this->atayalaRepository->create($data);
            }
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
        try {
            $dom = new Htmldom($url);
        } catch (\Exception $e) {
            return null;
        }

        $elems = $dom->find('div.media-body');
        $elems = str_replace("\t", '', $elems[0]->plaintext);

        $title = $dom->find('h3 a[itemprop=url]');
        $condos['title'] = substr($title[0]->plaintext, 0,  strlen($title[0]->plaintext));

        $descriptions = $dom->find('p[style=text-align: justify;]');
        $condos['descriptions'] = isset($descriptions[0]->plaintext) ? substr($descriptions[0]->plaintext, 3,  strlen($descriptions[0]->plaintext) - 9) : null;

        $condos['image_url'] = $dom->find('img[itemprop=image]')[0]->src;
        foreach ( explode("\r\n", $elems) as $key => $condo ) {
            $property = explode(':', $condo);
            if( count($property) == 2 ) {
                $condos[\StringHelper::camel2Snake($property[0])] = substr(preg_replace('!\s+!', ' ',$property[1]), 1, strlen(preg_replace('!\s+!', ' ',$property[1])) - 2);
            } else {
                $condos['condos_url'] = substr(preg_replace('!\s+!', ' ',$property[0]), 1, strlen(preg_replace('!\s+!', ' ',$property[0])) - 7);
            }
        }

        $location = $dom->find('div.media-body')[0]->find('span[itemprop=addressLocality]')[0]->plaintext . ', ' . $dom->find('div.media-body')[0]->find('span[itemprop=addressRegion]')[0]->plaintext;
        $condos['location'] = substr(preg_replace('!\s+!', ' ',$location), 1, strlen(preg_replace('!\s+!', ' ',$location)) - 2);

        return $condos;
    }
    // ------------ Phrealestate ------------

    // ------------ philpropertyexpert ------------
    private function getListPhilpropertyexpert($url)
    {
        try {
            $dom = new Htmldom($url);
        } catch (\Exception $e) {
            return null;
        }

        $elems = $dom->find('a.overlay');

        $urls = [];
        foreach ( $elems as $elem ) {
            $urls[] = $elem->href;
        }

        return array_unique($urls);

    }

    private function getDetailPhilpropertyexpert($url)
    {
        try {
            $dom = new Htmldom($url);
        } catch (\Exception $e) {
            return null;
        }

        $title = $dom->find('h2.prop-title');
        $condos['title'] = $title[0]->plaintext;

        $condos['image_url'] = isset($dom->find('img.media-object')[0]) ? $dom->find('img.media-object')[0]->src : null;

        $elems = $dom->find('li.info-label');
        foreach ( $elems as $elem ) {
            $property = explode(':', $elem->plaintext);
            $condos[\StringHelper::camel2Snake($property[0])] = substr(preg_replace('/\s+/', ' ', $property[1]), 1, strlen(preg_replace('/\s+/', ' ', $property[1])) - 2);
        }

        return $condos;
    }
    // ------------ philpropertyexpert ------------

    // ------------ PropertyAsia.ph ------------
    private function getListPropertyasia($url)
    {
        try {
            $dom = new Htmldom($url);
        } catch (\Exception $e) {
            return null;
        }

        $elems = $dom->find('div.property-list')[0]->find('a[itemprop=url]');

        $urls = [];
        foreach ( $elems as $elem ) {
            $urls[] = $elem->href;
        }

        return array_unique($urls);
    }

    private function getDetailPropertyasia($url)
    {
        try {
            $dom = new Htmldom($url);
        } catch (\Exception $e) {
            return null;
        }

        $title = preg_replace('/\s+/', ' ', $dom->find('h1.title')[0]->plaintext);
        $data['title'] = substr($title, 1, strlen($title) - 2);

        $address = $dom->find('div.top-info')[0]->find('span.location')[0]->plaintext;
        $data['address'] = substr(preg_replace('/\s+/', ' ', $address), 1, strlen(preg_replace('/\s+/', ' ', $address)) - 2);

        // ! unit_types
        $units = $dom->find('div.top-info')[0]->find('ul.specs')[0]->find('li');
        foreach ($units as $key => $unit) {
            $tmp = explode(':', $unit->plaintext);
            if( count($tmp) == 2 ) {
                $data[\StringHelper::camel2Snake($tmp[0])] = $tmp[1];
            }
        }

        // type, total_floor, total_units, year_built, available
        $infos = $dom->find('div.listing-info')[1]->find('p');
        foreach ($infos as $info) {
            $property = explode(': ', $info->plaintext);
            if( count($property) == 2 ) {
                $data[\StringHelper::camel2Snake($property[0])] = $property[1];
            }
        }

        // facilities
        $data['facilities'] = '';
        if( count($dom->find('div.amenity')) ) {
            $facilities = $dom->find('div.amenity')[0]->find('ul.list-unstyled')[0]->find('li');
            foreach ($facilities as $key => $facility) {
                $data['facilities'] .= $key ? ",$facility->plaintext" : $facility->plaintext;
            }
        }

        // image
        $data['image_url'] = $dom->find('div.p-img')[0]->find('img.img-responsive')[0]->getAttribute('data-src');

        // map
        $page = $this->get_url($url);
        $parsed = $this->get_string_between($page, "= new Array(", ');');
        $parsed = preg_replace('/\s+/', ' ', $parsed);
        $parsed = substr($parsed, 3, strlen($parsed) - 6);
        $lat= $this->get_string_between($parsed, 'Lat:', '],');
        $lng= $this->get_string_between($parsed, 'Lng:', '],');
        $data['latitude'] = substr($lat, 3, strlen($lat) - 4);
        $data['longitude'] = substr($lng, 3, strlen($lng) - 4);

        return $data;
    }
    // ------------ PropertyAsia.ph ------------

    // ------------ Avidaland.com ------------
    private function getListAvidaland($url)
    {
        try {
            $dom = new Htmldom($url);
        } catch (\Exception $e) {
            return null;
        }

        $elems = $dom->find('h3.property-project-name');

        $urls = [];
        foreach ( $elems as $elem ) {
            $urls[] = 'http://avidaland.com/' . $elem->find('a')[0]->href;
        }

        return array_unique($urls);
    }

    private function getDetailAvidaland($url)
    {
        try {
            $dom = new Htmldom($url);
        } catch (\Exception $e) {
            return null;
        }

        $data['title'] = $dom->find('div#projectConcept')[0]->find('h1')[0]->plaintext;

        // location, unit_sizes, price_range, status, complete_year
        $infos = $dom->find('div#projectConcept')[0]->find('div.col-5');
        foreach ( $infos as $info ) {
            $tmp = explode(':', $info->plaintext);
            if( count($tmp) == 2 ) {
                $field = preg_replace('/\s+/', ' ', $tmp[1]);
                $data[\StringHelper::camel2Snake($tmp[0])] = substr($field, 1, strlen($field) - 2);
            } elseif (count($tmp) == 1) {
                $complateYear = preg_replace('/\s+/', ' ', $info->plaintext);
                $data['complete_year'] = substr($complateYear, 17, strlen($complateYear) - 18);
            }
        }

        // map
        $data['latitude'] = $dom->find('div#map_canvas')[0]->getAttribute('lat');
        $data['longitude'] = $dom->find('div#map_canvas')[0]->getAttribute('long');
        $data['image_url'] = 'http://avidaland.com/' . $dom->find('img.project-banner-img')[0]->src;

        return $data;
    }
    // ------------ Avidaland.com ------------
}
