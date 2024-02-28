<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_rol
 * @property integer $id_aplicacion
 * @property string $nombre
 * @property Aplicacion $aplicacion
 */
class Rol extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rol_aplicacion';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_rol';

    /**
     * @var array
     */
    protected $fillable = ['id_aplicacion', 'nombre'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'seguridadapp';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function application()
    {
        return $this->belongsTo('App\Models\Application', 'id_aplicacion', 'id_aplicacion');
    }
}
