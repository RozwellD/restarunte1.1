<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLaboral extends Model
{
    use HasUuids, SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'puesto_id',
        'nss',
        'rfc',
        'salario_diario',
    ];

    protected $casts = [
        'user_id' => 'string',
    ];


    public function salarioDiario(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100
        );
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }




    public function puesto(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Puesto::class);
    }
}
