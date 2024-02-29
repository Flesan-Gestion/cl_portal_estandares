<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_aplicacion
 * @property string $nombre
 * @property string $descripcion
 * @property string $fecha_ini
 * @property string $fecha_fin
 * @property AplicacionUsuario[] $aplicacionUsuarios
 * @property RolAplicacion[] $rolAplicacions
 */
class Application extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'aplicacion';

    public $timestamps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_aplicacion';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion', 'fecha_ini', 'fecha_fin'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'seguridadapp';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'id_aplicacion', 'id_aplicacion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->hasMany('App\Models\Rol', 'id_aplicacion', 'id_aplicacion');
    }
}
