<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $st_speciality_id
 * @property integer $st_real_estate_id
 * @property integer $st_id
 * @property string $st_type_definition
 * @property string $st_request
 * @property string $st_description
 * @property string $st_information
 * @property string $st_code
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_create
 * @property string $user_update
 * @property integer $enable
 * @property Speciality $speciality
 * @property RealEstate $realEstate
 */
class Standard extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'standard';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'st_id';

    /**
     * @var array
     */
    protected $fillable = ['st_speciality_id', 'st_real_estate_id', 'st_type_definition', 'st_request', 'st_description', 'st_information', 'st_code', 'st_code_number', 'created_at', 'updated_at', 'user_create', 'user_update', 'enable'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'standard';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function speciality()
    {
        return $this->belongsTo('App\Models\Speciality', 'st_speciality_id', 'sp_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function realEstate()
    {
        return $this->belongsTo('App\Models\RealEstate', 'st_real_estate_id', 're_id');
    }
}
