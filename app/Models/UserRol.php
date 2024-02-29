<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_usuario_rol
 * @property integer $id_aplicacion_usuario
 * @property integer $id_rol
 * @property string $id_empresa
 * @property string $objeto_permitido
 * @property string $fecha_ini
 * @property string $fecha_fin
 * @property string $id_unidad_negocio
 * @property string $pais
 * @property integer $estado
 * @property AplicacionUsuario $aplicacionUsuario
 */
class UserRol extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'usuario_rol';

    public $timestamps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_usuario_rol';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_aplicacion_usuario', 'id_rol', 'id_empresa', 'objeto_permitido', 'fecha_ini', 'fecha_fin', 'id_unidad_negocio', 'pais', 'estado'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'seguridadapp';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_aplicacion_usuario', 'id_aplicacion_usuario');
    }
}
