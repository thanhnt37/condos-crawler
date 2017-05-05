<?php namespace App\Models;



class Condominiumsmanila extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'condominiumsmanilas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'postal_code',
        'country',
        'province',
        'city',
        'address',
        'building_type',
        'latitude',
        'longitude',
        'completion_year',
        'number_floor',
        'number_unit',
        'developer_name',
        'facilities',
        'unit_size',
        'condo_url',
        'developer_url',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\CondominiumsmanilaPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\CondominiumsmanilaObserver);
    }

    // Relations
    

    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'address' => $this->address,
            'building_type' => $this->building_type,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'completion_year' => $this->completion_year,
            'number_floor' => $this->number_floor,
            'number_unit' => $this->number_unit,
            'developer_name' => $this->developer_name,
            'facilities' => $this->facilities,
            'unit_size' => $this->unit_size,
            'condo_url' => $this->condo_url,
            'developer_url' => $this->developer_url,
        ];
    }

}
