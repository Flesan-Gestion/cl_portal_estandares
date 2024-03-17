<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $cm_id
 * @property integer $cm_standard_id
 * @property string $cm_comment
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_create
 * @property string $user_update
 * @property integer $enable
 * @property Standard $standard
 */
class Comment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'comment';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cm_id';

    /**
     * @var array
     */
    protected $fillable = ['cm_standard_id', 'cm_comment', 'created_at', 'updated_at', 'user_create', 'user_update', 'enable'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'standard';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function standard()
    {
        return $this->belongsTo('App\Models\Standard', 'cm_standard_id', 'st_id');
    }
}
