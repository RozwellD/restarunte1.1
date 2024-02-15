<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlatilloRequest;
use App\Http\Resources\PlatilloResource;
use App\Models\Platillo;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class PlatilloController extends Controller
{
    public function index(Request $request, Sucursal $sucursalId)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'data' => [
                    'platillos' => PlatilloResource::collection(Platillo::whereBranchId($sucursalId->id)->get())
                ]
            ]);
        }
        return inertia()->render('Sucursales/Platillos/index', [
            'platillos' => PlatilloResource::collection(Platillo::whereBranchId($sucursalId->id)->paginate(10))
        ]);
    }

    public function store(PlatilloRequest $request)
    {

        try {

            \DB::beginTransaction();
            Platillo::create($request->validated());
            \DB::commit();

            return redirect()->back()->with('success', 'Platillo creado');
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'No se pudo almacenar, intenta mas tarde');
        }

    }

    public function show(Platillo $platillo)
    {
        return new PlatilloResource($platillo);
    }

    public function update(PlatilloRequest $request, Platillo $platillo)
    {

        try {
            \DB::beginTransaction();
            $platillo->update($request->validated());
            \DB::commit();

            return redirect()->back()->with('success', 'Platillo actualizado');
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'No se pudo almacenar, intenta mas tarde');
        }


    }

    public function destroy(Platillo $platillo)
    {
        $platillo->delete();

        return response()->json();
    }
}
