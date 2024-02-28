<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property integer $id_aplicacion_usuario
 * @property integer $id_aplicacion
 * @property string $username
 * @property string $fecha_ini
 * @property string $fecha_fin
 * @property string $name
 * @property string $provider
 * @property string $provider_id
 * @property string $remember_token
 * @property integer $estado_sesion
 * @property string $fecha_validacion
 * @property string $dni
 * @property string $nombres
 * @property string $apellidos
 * @property integer $estado_validacion
 * @property string $pais
 * @property string $refresh_token
 * @property string $avatar
 * @property string $password
 * @property UsuarioRol[] $usuarioRols
 * @property Aplicacion $aplicacion
 */
class User extends Authenticatable implements JWTSubject
{

    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'aplicacion_usuario';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_aplicacion_usuario';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_aplicacion', 'username', 'fecha_ini', 'fecha_fin', 'name', 'provider', 'provider_id', 'remember_token', 'estado_sesion', 'fecha_validacion', 'dni', 'nombres', 'apellidos', 'estado_validacion', 'pais', 'refresh_token', 'avatar', 'password'];

    /**
     * The connection name for the model.
     * 
     * @var string
     */
    protected $connection = 'seguridadapp';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarioRols()
    {
        return $this->hasMany('App\Models\UserRol', 'id_aplicacion_usuario', 'id_aplicacion_usuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function application()
    {
        return $this->belongsTo('App\Models\Application', 'id_aplicacion', 'id_aplicacion');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
