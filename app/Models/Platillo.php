<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platillo extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'elaboration_duration',
        'production_cost',
        'sale_price',
        'branch_id',
        'active'
    ];

    protected $casts = [
        'branch_id' => 'string',
        'active' => 'boolean',
    ];

    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sucursal::class);
    }
}
