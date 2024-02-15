<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuestoResource;
use App\Http\Resources\SucursalResource;
use App\Http\Resources\UserResource;
use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Termwind\Components\Dd;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereHas('laboral')->with('sucursal')->orderByDesc('created_at')->paginate(\request()->query('itemsPerPage', 10));

        return inertia()->render('Users/index', [
            'users' => UserResource::collection($users),
            'puestos' => Puesto::all()->map(function (Puesto $puesto, int $key) {
                return [
                    'label' => $puesto->name,
                    'value' => $puesto->id,
                ];
            }),
            'sucursales' => Sucursal::all()->map(function (Sucursal $sucursal, int $key) {
                return [
                    'label' => $sucursal->name,
                    'value' => $sucursal->id,
                ];
            })
        ]);
    }

    public function getUsersByType($type)
    {
        $users = User::whereHas('laboral')->with('sucursal')->where('type', $type)->orderByDesc('created_at')->get()->map(function (User $user) {
            return [
                'label' => $user->name,
                'value' => $user->id
            ];
        });

        return response()->json($users);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits:10',
            'puesto' => 'required|uuid|exists:puestos,id',
            'sucursal' => 'required|uuid|exists:sucursals,id',
        ]);


        try {

            \DB::beginTransaction();


            $puesto = Puesto::find($data['puesto']);


            $user = User::create([
                'email' => $data['email'],
                'name' => $data['name'],
                'password' => \Hash::make('password'),
                'phone' => $data['phone'],
                'type' => $puesto->slug,
                'sucursal_id' => $data['sucursal']
            ]);


            $user->laboral()->create([
                'puesto_id' => $puesto->id,
                'rfc' => "sapd920612",
                'nss' => "12312312312",
                'salario_diario' => 24849 * 100
            ]);


            \DB::commit();

            return redirect()->back()->with('success', 'Usuario creado');
        } catch (\Exception $exception) {


            Log::error($exception->getMessage());


            \DB::rollBack();


            return redirect()->back()->with('error', 'Ocurrio un error al crear el usuario');
        }
    }

    public function update(Request $request, User $userId)
    {

        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email,' . $userId->id,
            'phone' => 'required|numeric|digits:10',
            'salario_diario' => 'required|numeric',
            'puesto' => 'required|uuid|exists:puestos,id',
            'sucursal' => 'required|uuid|exists:sucursals,id',
        ]);


        try {

            \DB::beginTransaction();


            $puesto = Puesto::find($data['puesto']);


            $userId->update([
                'email' => $data['email'],
                'name' => $data['name'],
                'phone' => $data['phone'],
                'type' => $puesto->slug,
                'sucursal_id' => $data['sucursal']
            ]);


            $userId->laboral()->update([
                'puesto_id' => $puesto->id,
                'rfc' => "sapd920612",
                'nss' => "12312312312",
                'salario_diario' => $data['salario_diario'] * 100
            ]);


            \DB::commit();

            return redirect()->back()->with('success', 'Usuario actualizado');
        } catch (\Exception $exception) {


            Log::error($exception->getMessage());


            \DB::rollBack();


            return redirect()->back()->with('error', 'Ocurrio un error al crear el usuario');
        }
    }
}
