<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $members = User::with(['incomes'])->get();
        $dataPoints = [];
        foreach ($members as $member) {
            $income = $member->incomes->sum('price');
            $dataPoints[] = array(
                "name"  => $member['name'],
                intval($income),
            );
        }
        return view('dashboard', [
            'data'  => json_encode($dataPoints),
            'terms' => json_encode([
                'Profit',
                'Balance',
                'Rugi'
            ])
        ]);
    }
}
