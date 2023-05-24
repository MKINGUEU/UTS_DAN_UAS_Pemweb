<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBeasiswaRequest;
use App\Http\Requests\UpdateBeasiswaRequest;
use App\Http\Resources\Admin\BeasiswaResource;
use App\Models\Beasiswa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BeasiswaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('beasiswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BeasiswaResource(Beasiswa::all());
    }

    public function store(StoreBeasiswaRequest $request)
    {
        $beasiswa = Beasiswa::create($request->all());

        return (new BeasiswaResource($beasiswa))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Beasiswa $beasiswa)
    {
        abort_if(Gate::denies('beasiswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BeasiswaResource($beasiswa);
    }

    public function update(UpdateBeasiswaRequest $request, Beasiswa $beasiswa)
    {
        $beasiswa->update($request->all());

        return (new BeasiswaResource($beasiswa))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Beasiswa $beasiswa)
    {
        abort_if(Gate::denies('beasiswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $beasiswa->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
