<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $fillable = [
        'table',
        'attendant_id',
        'platillos_id',
        'tip',
        'date',
        'branch_id',
    ];

    protected $casts = [
        'attendant_id' => 'string',
        'platillos_id' => "array",
        'date' => 'date'
    ];

    public function attendant()
    {
        return $this->belongsTo(User::class, 'attendant_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Sucursal::class, 'branch_id', 'id');
    }
    public function platillos()
    {
        return $this->hasMany(Platillo::class, 'id', 'platillos_id');
    }
}
