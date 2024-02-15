<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasUuids, SoftDeletes, HasFactory;


    protected $fillable = [
        "user_id",
        "id",
        "address",
        "address2",
        "ext",
        "type",
        "int",
        "cp",
        "city",
        "state",
        "country"
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

}
