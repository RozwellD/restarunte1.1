<?php

namespace App\Http\Controllers;

use App\Http\Requests\SucursalRequest;
use App\Http\Resources\SucursalResource;
use App\Models\Sucursal;

class SucursalController extends Controller
{
    public function index()
    {

        $sucursales= Sucursal::orderByDesc('created_at')->paginate(\request()->query('itemsPerPage', 10));

        return inertia()->render('Sucursales/index', [
            'sucursales' => SucursalResource::collection($sucursales)
        ]);
    }

    public function store(SucursalRequest $request)
    {
        $this->authorize('create', Sucursal::class);

        return new SucursalResource(Sucursal::create($request->validated()));
    }

    public function show(Sucursal $sucursal)
    {
        $this->authorize('view', $sucursal);

        return new SucursalResource($sucursal);
    }

    public function update(SucursalRequest $request, Sucursal $sucursal)
    {


        $sucursal->update($request->validated());

        return new SucursalResource($sucursal);
    }

    public function destroy(Sucursal $sucursal)
    {
        $this->authorize('delete', $sucursal);

        $sucursal->delete();

        return response()->json();
    }
}
