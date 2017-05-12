<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\APIRequest;
use App\Repositories\UserRepositoryInterface;
use App\Services\FileUploadServiceInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\CondominiumsmanilaRepositoryInterface;
use App\Repositories\PhrealestateRepositoryInterface;
use App\Repositories\PhilpropertyexpertRepositoryInterface;
use App\Repositories\PropertyasiaRepositoryInterface;
use App\Repositories\AvidalandRepositoryInterface;
use App\Repositories\AtayalaRepositoryInterface;

class BuildingController extends Controller
{
    /** @var \App\Repositories\UserRepositoryInterface */
    protected $userRepository;

    /** @var FileUploadServiceInterface $fileUploadService */
    protected $fileUploadService;

    /** @var ImageRepositoryInterface $imageRepository */
    protected $imageRepository;

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
        UserRepositoryInterface                 $userRepository,
        FileUploadServiceInterface              $fileUploadService,
        ImageRepositoryInterface                $imageRepository,
        CondominiumsmanilaRepositoryInterface   $condominiumsmanilaRepository,
        PhrealestateRepositoryInterface         $phrealestateRepository,
        PhilpropertyexpertRepositoryInterface   $philpropertyexpertRepository,
        PropertyasiaRepositoryInterface         $propertyasiaRepository,
        AvidalandRepositoryInterface            $avidalandRepository,
        AtayalaRepositoryInterface              $atayalaRepository
    ) {
        $this->userRepository                   = $userRepository;
        $this->fileUploadService                = $fileUploadService;
        $this->imageRepository                  = $imageRepository;
        $this->condominiumsmanilaRepository     = $condominiumsmanilaRepository;
        $this->phrealestateRepository           = $phrealestateRepository;
        $this->philpropertyexpertRepository     = $philpropertyexpertRepository;
        $this->propertyasiaRepository           = $propertyasiaRepository;
        $this->avidalandRepository              = $avidalandRepository;
        $this->atayalaRepository                = $atayalaRepository;
    }

    public function merge(APIRequest $request)
    {
        $data = $request->all();
        $paramsAllow = [
            'string'   => [
                'model'
            ],
            'numeric'  => [
                '>=0' => ['condo_id', 'similar_id']
            ]
        ];
        $paramsRequire = ['model', 'condo_id', 'similar_id'];
        $validate = $request->checkParams($data, $paramsAllow, $paramsRequire);
        if ($validate['code'] != 100) {
            return $this->response($validate['code']);
        }
        $data = $validate['data'];

        $condos = $this->propertyasiaRepository->find($data['condo_id']);
        $repos  = $data['model'] . 'Repository';
        $similar = $this->$repos->find($data['similar_id']);
        if( empty($condos) || empty($similar) ) {
            return $this->response(902);
        }

        $update = [];
        foreach ($condos as $key => $value) {
            if( is_null($value) || $value == '' ) {
                $update[$key] = $similar[$key];
            }
        }
        if( $condos['latitude'] == 0 || $condos['longitude'] == 0 ) {
            $update['latitude'] = $similar['latitude'];
            $update['longitude'] = $similar['longitude'];
        }
        try {
            $this->propertyasiaRepository->update($condos, $update);
            $this->$repos->delete($similar);
        } catch (\Exception $e) {
            return $this->response(901);
        }

        return $this->response(100);
    }

    public function import(APIRequest $request)
    {
        $data = $request->all();
        $paramsAllow = [
            'string'   => [
                'model'
            ],
            'numeric'  => [
                '>=0' => ['similar_id']
            ]
        ];
        $paramsRequire = ['model', 'similar_id'];
        $validate = $request->checkParams($data, $paramsAllow, $paramsRequire);
        if ($validate['code'] != 100) {
            return $this->response($validate['code']);
        }
        $data = $validate['data'];

        $repos  = $data['model'] . 'Repository';
        $similar = $this->$repos->find($data['similar_id']);
        if( empty($similar) ) {
            return $this->response(902);
        }

        try {
            $this->propertyasiaRepository->create($similar->toArray());
            $this->$repos->delete($similar);
        } catch (\Exception $e) {
            return $this->response(901);
        }

        return $this->response(100);
    }
}