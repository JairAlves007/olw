<?php

namespace App\Http\Controllers;

use App\Exports\BeerExport;
use App\Http\Requests\BeerRequest;
use App\Jobs\ExportJob;
use App\Jobs\SendExportEmailJob;
use App\Jobs\StoreExportDataJob;
use App\Mail\ExportEmail;
use App\Models\Export;
use App\Models\Meal;
use App\Services\PunkApiService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class BeerController extends Controller
{
    public function index(BeerRequest $request, PunkApiService $service)
    {
        $beers = $service->getBeers(...$request->validated());
        $meals = Meal::all();

        return Inertia::render('Beers', [
            'beers' => $beers,
            'meals' => $meals,
            'filters' => $request->validated()
        ]);
    }

    public function export(BeerRequest $request)
    {
        $user = auth()->user();
        $filename = "cervejas-encontradas-" . now()->format('Y-m-d-H_i') . ".xlsx";

        ExportJob::withChain([
            new SendExportEmailJob($user, $filename),
            new StoreExportDataJob($user, $filename)
        ])->dispatch(
            $request->validated(),
            $filename
        );

        return redirect()->back()->with('success', 'Seu arquivo foi enviado para processamento e em brave estará no seu e-mail');
    }
}
