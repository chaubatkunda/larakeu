<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.member.index', [
            'users' => User::with(['incomes', 'expendirures'])->oldest('name')->get()
        ]);
    }

    public function show(User $user)
    {
        // $dataPoints = [];
        $pro = $user->incomes->sum('price') + $user->expendirures->sum('price');
        $dataPoints = array(
            intval($user->incomes->sum('price')),
            intval($user->incomes->sum('price') - $user->expendirures->sum('price')),
            intval($user->incomes->sum('price') - $pro)
        );
        return view('pages.member.show', [
            'user'  => $user,
            'data'  => json_encode($dataPoints),
            'terms' => json_encode([
                'Profit',
                'Balance',
                'Rugi'
            ])
        ]);
    }
}
