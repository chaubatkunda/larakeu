<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function masuk(Request $request)
    {
        $start_date = Carbon::parse($request->awal)
            ->toDateTimeString();
        $end_date = Carbon::parse($request->akhir)
            ->toDateTimeString();

        if ($request->awal && $request->akhir) {
            $incomes = Income::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $incomes = Income::where("created_at", ">", Carbon::now()->subMonths())->get();
        }
        return view('pages.laporan.masuk', [
            'incomes'   => $incomes
        ]);
    }
    public function keluar(Request $request)
    {
        $start_date = Carbon::parse($request->awal)
            ->toDateTimeString();
        $end_date = Carbon::parse($request->akhir)
            ->toDateTimeString();

        if ($request->awal && $request->akhir) {
            $incomes = Expenditure::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $incomes = Expenditure::where("created_at", ">", Carbon::now()->subMonths())->get();
        }
        return view('pages.laporan.keluar', [
            'incomes'   => $incomes
        ]);
    }
}
