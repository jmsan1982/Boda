<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Invitado
 *
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * @property bool $confirmado
 * @property bool $viene_pareja
 * @property string|null $nombre_pareja
 * @property bool $viene_hijos
 * @property string|null $nombres_hijos
 * @property string|null $comentarios
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Invitado extends Model
{
	protected $table = 'invitados';

	protected $casts = [
		'confirmado' => 'bool',
		'viene_pareja' => 'bool',
		'viene_hijos' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'codigo',
		'confirmado',
		'viene_pareja',
		'nombre_pareja',
		'viene_hijos',
        'numero_hijos',
		'nombres_hijos',
		'comentarios'
	];
}
