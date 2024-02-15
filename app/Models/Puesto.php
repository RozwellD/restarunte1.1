<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Boolean;

class Puesto extends Model
{
    use HasUuids, SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'active',
    ];


    protected $casts = [
        'active' => 'bool'
    ];

    public function laboral(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserLaboral::class);
    }

}
