<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

/** @mixin \App\Models\Platillo */
class PlatilloResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => ucfirst($this->name),
            'description' => $this->description,
            'elaboration_duration' => $this->elaboration_duration,
            'production_cost' => $this->production_cost,
            'sale_price' => Number::currency($this->sale_price),
            'branch' => $this->branch,
            'active' => $this->active
        ];
    }
}
