<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use App\Models\Expenditure;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $incomes = Income::query()
                ->whereUserId(Auth::id());
            return DataTables::of($incomes)
                ->addColumn('action', function ($income) {
                    return '
                    <a class="btn btn-primary btn-sm border-0" href="' . route('pemasukan.edit', $income) . ' ">
                      Edit
                    </a>
                    <form action="' . route('pemasukan.destroy', $income) . '" method="post" class="d-inline">
                     ' .  method_field('delete') . csrf_field() . '
                    <button type="submit" class="btn btn-danger btn-sm border-0">
                        Delete
                    </button>
                    </form>
                    ';
                })
                ->editColumn('price', function ($income) {
                    return rupiah($income->price);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $countPemasukan = Income::whereUserId(Auth::id())->sum('price');
        $countPengeluaran = Expenditure::whereUserId(Auth::id())->sum('price');
        return view('pages.uang-masuk.index', compact('countPemasukan', 'countPengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.uang-masuk.create', [
            'pemasukan' => new Income()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncomeRequest $request)
    {
        Income::create([
            'user_id'   => Auth::id(),
            'price'     => $request->price,
            'keterangan'    => $request->keterangan
        ]);
        Alert::toast("Berhasil ditambahkan", "success");
        return redirect()->route('pemasukan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $pemasukan)
    {
        return view('pages.uang-masuk.edit', compact('pemasukan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IncomeRequest $request, Income $pemasukan)
    {
        $pemasukan->update([
            'user_id'   => Auth::id(),
            'price'     => $request->price,
            'keterangan'    => $request->keterangan
        ]);
        Alert::toast("Berhasil diupdate", "success");
        return redirect()->route('pemasukan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $pemasukan)
    {
        $pemasukan->delete();
        Alert::toast("Berhasil dihapus", "success");
        return redirect()->route('pemasukan.index');
    }
    public function cetak()
    {
        $data['incomes'] = Income::whereUserId(Auth::id())->get();
        // $data['sumTotalPengeluaran'] = Expenditure::whereUserId(Auth::id())->get();
        $pdf = PDF::loadView('pages.uang-masuk.cetak', $data, [], [
            'title' => 'Cetak Pengeluaran'
        ]);
        return $pdf->stream();
    }
}
