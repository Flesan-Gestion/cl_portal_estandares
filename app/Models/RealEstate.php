<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $re_id
 * @property string $re_description
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_create
 * @property string $user_update
 * @property integer $enable
 * @property Standard[] $standards
 */
class RealEstate extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'real_estate';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 're_id';

    /**
     * @var array
     */
    protected $fillable = ['re_description', 'created_at', 'updated_at', 'user_create', 'user_update', 'enable'];

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
        return $this->hasMany('App\Models\Standard', 'st_real_estate_id', 're_id');
    }
}
