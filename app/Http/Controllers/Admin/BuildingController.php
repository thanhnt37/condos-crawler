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
        $similars   = $this->$repos->all()->pluck('title', 'id');

        $buildings = [];
        $index = 0;
        foreach ( $condos as $key => $condo ) {
            foreach ( $similars as $key2 => $similar ) {
                $check = $this->checkSimilar($condo, $similar);
                $buildings[$index]['condo_id'] = $key;
                $buildings[$index]['similar_id'] = $key2;
                $buildings[$index]['condo'] = $condo;
                $buildings[$index]['similar'] = $similar;
                $buildings[$index]['percent_similar'] = $check['percent_similar'];
                $buildings[$index]['percent_keyword'] = $check['percent_keyword'];
                $index++;
                if( ($check['percent_similar'] <= 10 && $check['percent_keyword'] <= 10) || ($check['percent_similar'] >= 75 && $check['percent_keyword'] >= 75) ) {

                }
            }
        }

        return view('pages.admin.' . config('view.admin') . '.buildings.index', [
            'buildings' => $buildings,
            'site'      => $site
        ]);
    }

    private function checkSimilar($keyword, $text)
    {
//        $input =  $this->generateKeywordsFromText($text);
        $input =  strtolower($text);

        $similar        = similar_text(strtolower($keyword), $input, $percentSimilar);
        $percentKeyword = (strlen($keyword) == 0) ? 0 : (($similar/strlen($keyword)) * 100);

        $data['percent_similar'] = $percentSimilar;
        $data['percent_keyword'] = $percentKeyword;

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
