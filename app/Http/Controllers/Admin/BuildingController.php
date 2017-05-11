<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use App\Repositories\CondominiumsmanilaRepositoryInterface;
use App\Repositories\PhrealestateRepositoryInterface;
use App\Repositories\PhilpropertyexpertRepositoryInterface;
use App\Repositories\PropertyasiaRepositoryInterface;

class BuildingController extends Controller
{
    /** @var \App\Repositories\CondominiumsmanilaRepositoryInterface */
    protected $condominiumsmanilaRepository;

    /** @var \App\Repositories\PhrealestateRepositoryInterface */
    protected $phrealestateRepository;

    /** @var \App\Repositories\PhilpropertyexpertRepositoryInterface */
    protected $philpropertyexpertRepository;

    /** @var \App\Repositories\PropertyasiaRepositoryInterface */
    protected $propertyasiaRepository;

    public function __construct(
        CondominiumsmanilaRepositoryInterface   $condominiumsmanilaRepository,
        PhrealestateRepositoryInterface         $phrealestateRepository,
        PhilpropertyexpertRepositoryInterface   $philpropertyexpertRepository,
        PropertyasiaRepositoryInterface         $propertyasiaRepository
    )
    {
        $this->condominiumsmanilaRepository     = $condominiumsmanilaRepository;
        $this->phrealestateRepository           = $phrealestateRepository;
        $this->philpropertyexpertRepository     = $philpropertyexpertRepository;
        $this->propertyasiaRepository           = $propertyasiaRepository;
    }

    public function index(BaseRequest $request)
    {
        $site       = $request->get('site', 'phrealestate');
        $repos      = $site . 'Repository';
        $condos     = $this->propertyasiaRepository->all()->pluck('title', 'id');
        $similars   = $this->$repos->get('id', 'asc', 0, 15)->pluck('title', 'id');

        $buildings = [];
        $index = 0;
        foreach ( $similars as $key2 => $similar ) {
            foreach ( $condos as $key => $condo ) {
                $check = $this->checkSimilar($condo, $similar);

                $buildings[$index]['condo_id'] = $key;
                $buildings[$index]['similar_id'] = $key2;
                $buildings[$index]['condo'] = $condo;
                $buildings[$index]['similar'] = $similar;
                $buildings[$index]['percent_similar'] = $check['percent_similar'];
                $buildings[$index]['percent_keyword'] = $check['percent_keyword'];

                $index++;
            }
        }

        return view('pages.admin.' . config('view.admin') . '.buildings.index', [
            'buildings' => $buildings,
            'site'      => $site,
            'count'     => $this->$repos->count()
        ]);
    }

    private function checkSimilar($keyword, $similarText)
    {
//        $input =  $this->generateKeywordsFromText($similarText);
        $input =  strtolower($similarText);
        $keyword = strtolower($keyword);

        $similar        = similar_text($keyword, $input, $percentSimilar);
        $percentKeyword1 = (strlen($keyword) == 0) ? 0 : (($similar/strlen($keyword)) * 100);
        $percentKeyword2 = (strlen($similarText) == 0) ? 0 : (($similar/strlen($similarText)) * 100);

        $data['percent_similar'] = $percentSimilar;
        $data['percent_keyword'] = ($percentKeyword1 > $percentKeyword2) ? $percentKeyword1 : $percentKeyword2;

        return $data;
    }

    private function generateKeywordsFromText($text){


        // List of words NOT to be included in keywords
        $stopWords = array('i','a','about','an','and','are','as','at','be','by','com','de','en','for','from','how','in','is','it','la','of','on','or','that','the','this','to','was','what','when','where','who','will','with','und','the','www', "such", "have", "then");


        //Let us do some basic clean up! on the text before getting to real keyword generation work

        $text = preg_replace('/\s\s+/i', '', $text); // replace multiple spaces etc. in the text
        $text = trim($text); // trim any extra spaces at start or end of the text
        $text = preg_replace('/[^a-zA-Z0-9 -]/', '', $text); // only take alphanumerical characters, but keep the spaces and dashes too…
        $text = strtolower($text); // Make the text lowercase so that output is in lowercase and whole operation is case in sensitive.

        // Find all words
        preg_match_all('/\b.*?\b/i', $text, $allTheWords);
        $allTheWords = $allTheWords[0];

        //Now loop through the whole list and remove smaller or empty words
        foreach ( $allTheWords as $key=>$item ) {
            if ( $item == '' || in_array(strtolower($item), $stopWords) || strlen($item) <= 3 ) {
                unset($allTheWords[$key]);
            }
        }

        // Create array that will later have its index as keyword and value as keyword count.
        $wordCountArr = array();

        // Now populate this array with keywrds and the occurance count
        if ( is_array($allTheWords) ) {
            foreach ( $allTheWords as $key => $val ) {
                $val = strtolower($val);
                if ( isset($wordCountArr[$val]) ) {
                    $wordCountArr[$val]++;
                } else {
                    $wordCountArr[$val] = 1;
                }
            }
        }

        // Sort array by the number of repetitions
        arsort($wordCountArr);

        //Keep first 10 keywords, throw other keywords
        $wordCountArr = array_slice($wordCountArr, 0, 10);

        // Now generate comma separated list from the array
        $words="";
        foreach  ($wordCountArr as $key=>$value)
            $words .= ", " . $key ;

        // Trim list of comma separated keyword list and return the list
        return trim($words,",");
    }
}
