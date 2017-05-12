<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CondominiumsmanilaRepositoryInterface;
use App\Repositories\PhrealestateRepositoryInterface;

class IndexController extends Controller
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
        $keyword = 'Greenbelt Axcelsior';
        $input = 'Greenbelt Excelsior by Megaworld asdada asdaaas vfdb d db  d ';

//        $philpropertyexperts = $this->phrealestateRepository->all()->pluck('title', 'id');
//        $condominiumsmanilas = $this->condominiumsmanilaRepository->all()->pluck('title', 'id');
//
//        foreach ( $philpropertyexperts as $key => $philpropertyexpert ) {
//            foreach ( $condominiumsmanilas as $key2 => $condominiumsmanila ) {
//                if( $this->checkSimilar($philpropertyexpert, $condominiumsmanila) ) {
//                    echo $philpropertyexpert . '|-----|' . $condominiumsmanila . '<br>';
//                } else {
////                    echo 'no similar';
//                }
//            }
//        }

        return view('pages.admin.' . config('view.admin') . '.index', [
        ]);
    }

    private function checkSimilar($keyword, $text)
    {
        $input =  $this->generateKeywordsFromText($text);
        $input =  strtolower($text);

        $similar        = similar_text(strtolower($keyword), $input, $percentSimilar);
        $percentKeyword = ($similar/strlen($keyword)) * 100;

        if( $percentSimilar >= 50 || $percentKeyword >= 85 ) {
            echo "percentSimilar: $percentSimilar, percentKeyword: $percentKeyword | ";
            return true;
        } else {
            return false;
        }
        return ( $percentSimilar >= 50 || $percentKeyword >= 85 ) ? true : false;
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
