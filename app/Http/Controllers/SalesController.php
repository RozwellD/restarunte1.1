<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalesRequest;
use App\Http\Resources\SalesResource;
use App\Models\Sales;
use App\Models\Sucursal;

class SalesController extends Controller
{
    public function index()
    {
        $sales = SalesResource::collection(Sales::paginate(10));
        $sucursales = Sucursal::all()->map(function (Sucursal $sucursal, int $key) {
            return [
                'label' => $sucursal->name,
                'value' => $sucursal->id,
            ];
        });

        return inertia()->render('Sales/index', [
            'sales' => $sales,
            'sucursales' => $sucursales
        ]);
    }

    public function store(SalesRequest $request)
    {
        try {

            \DB::beginTransaction();


            $sales = Sales::create($request->validated());

            \DB::commit();

            return redirect()->back()->with('success', 'Venta creada correctamente');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear la venta');
        }
    }

    public function show(Sales $sales)
    {
        $this->authorize('view', $sales);

        return new SalesResource($sales);
    }

    public function update(SalesRequest $request, Sales $sales)
    {
        $this->authorize('update', $sales);

        $sales->update($request->validated());

        return new SalesResource($sales);
    }

    public function destroy(Sales $sales)
    {
        $this->authorize('delete', $sales);

        $sales->delete();

        return response()->json();
    }
}
