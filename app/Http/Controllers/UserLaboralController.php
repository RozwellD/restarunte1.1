<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLaboralRequest;
use App\Models\UserLaboral;

class UserLaboralController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', UserLaboral::class);

        return UserLaboral::all();
    }

    public function store(UserLaboralRequest $request)
    {
        $this->authorize('create', UserLaboral::class);

        return UserLaboral::create($request->validated());
    }

    public function show(UserLaboral $userLaboral)
    {
        $this->authorize('view', $userLaboral);

        return $userLaboral;
    }

    public function update(UserLaboralRequest $request, UserLaboral $userLaboral)
    {
        $this->authorize('update', $userLaboral);

        $userLaboral->update($request->validated());

        return $userLaboral;
    }

    public function destroy(UserLaboral $userLaboral)
    {
        $this->authorize('delete', $userLaboral);

        $userLaboral->delete();

        return response()->json();
    }
}
