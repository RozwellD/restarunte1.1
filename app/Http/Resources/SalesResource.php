<?php

namespace App\Http\Resources;

use App\Models\Platillo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Sales */
class SalesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'attendant' => $this->attendant,
            'branch_id' => $this->branch_id,
            'platillos' => $this->getPlatillos(),
            'platillos_count' => count($this->platillos_id),
            'table' => $this->table,
            'tip' => $this->tip,
            'date' => $this->date,
        ];
    }


    public function getPlatillos()
    {
        $platillos = [];

        foreach ($this->platillos_id as $item) {
            $item = Platillo::find($item);
            $platillos[] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->sale_price,
            ];
        }

        return $platillos;
    }
}
