<?php

namespace App\Http\Controllers;

use App\Models\{Expenditure, Income, User};
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $memeberMo = User::where("created_at", ">", Carbon::now()->subMonths())->get();
        $startMonthInc = Income::where("created_at", ">", Carbon::now()->subMonths())->get();
        $startMonthEx = Expenditure::where("created_at", ">", Carbon::now()->subMonths())->get();
        $income = $startMonthInc->sum('price');
        $balance = $income - $startMonthEx->sum('price');
        $rugi = $income + $startMonthEx->sum('price');
        $dataPoints = [
            intval($income),
            intval($balance),
            intval($income - $rugi)
        ];

        return view('dashboard', [
            'balance'   => $balance,
            'profit'    => $income,
            'rugi'      => $rugi,
            'data'  => json_encode($dataPoints),
            'laps' => json_encode([
                'Profit',
                'Balance',
                'Rugi'
            ])
        ]);
    }
}
