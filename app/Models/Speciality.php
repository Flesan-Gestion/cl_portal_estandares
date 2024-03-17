<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $sp_prefix_code_id
 * @property integer $sp_id
 * @property string $sp_description
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_create
 * @property string $user_update
 * @property integer $enable
 * @property Standard[] $standards
 * @property PrefixCode $prefixCode
 */
class Speciality extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'speciality';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'sp_id';

    /**
     * @var array
     */
    protected $fillable = ['sp_prefix_code_id', 'sp_description', 'created_at', 'updated_at', 'user_create', 'user_update', 'enable'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'standard';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function standards()
    {
        return $this->hasMany('App\Models\Standard', 'st_speciality_id', 'sp_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prefixCode()
    {
        return $this->belongsTo('App\Models\PrefixCode', 'sp_prefix_code_id', 'pc_id');
    }
}
