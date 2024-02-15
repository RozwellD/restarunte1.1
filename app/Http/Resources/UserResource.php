<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->type,
            'salario_diario' => $this->laboral->salario_diario / 100,
            'puesto' => $this->laboral->puesto,
            'sucursal' => new SucursalResource($this->whenLoaded('sucursal')),
        ];
    }
}
