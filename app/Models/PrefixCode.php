<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $pc_id
 * @property string $pc_description
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_create
 * @property string $user_update
 * @property integer $enable
 * @property Speciality[] $specialities
 */
class PrefixCode extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prefix_code';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'pc_id';

    /**
     * @var array
     */
    protected $fillable = ['pc_description', 'created_at', 'updated_at', 'user_create', 'user_update', 'enable'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'standard';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specialities()
    {
        return $this->hasMany('App\Models\Speciality', 'sp_prefix_code_id', 'pc_id');
    }
}
