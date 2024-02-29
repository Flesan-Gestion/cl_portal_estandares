<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $correlativo
 * @property string $identifier
 * @property string $especialidad
 * @property string $inmobiliaria
 * @property string $tipo_definicion
 * @property string $requerimiento
 * @property string $descripcion
 * @property string $informacion
 * @property string $comentarios
 * @property integer $enable
 * @property string $user_create
 * @property string $user_update
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_comment
 */
class Standard extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'estandar_inmobiliario';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'correlativo';

    /**
     * @var array
     */
    protected $fillable = ['correlativo', 'identifier', 'especialidad', 'inmobiliaria', 'tipo_definicion', 'requerimiento', 'descripcion', 'informacion', 'comentarios', 'enable', 'user_create', 'user_update', 'created_at', 'updated_at', 'user_comment'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'dw_chile';
}
