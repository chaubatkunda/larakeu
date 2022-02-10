<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenditureRequest;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $expenditures = Expenditure::query()
                ->whereUserId(Auth::id());
            return DataTables::of($expenditures)
                ->addColumn('action', function ($expenditure) {
                    return '
                    <a class="btn btn-primary btn-sm border-0" href="' . route('pengeluaran.edit', $expenditure) . ' ">
                      Edit
                    </a>
                    <form action="' . route('pengeluaran.destroy', $expenditure) . '" method="post" class="d-inline">
                     ' .  method_field('delete') . csrf_field() . '
                    <button type="submit" class="btn btn-danger btn-sm border-0">
                        Delete
                    </button>
                    </form>
                    ';
                })
                ->editColumn('price', function ($expenditure) {
                    return rupiah($expenditure->price);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $countPrice = Expenditure::whereUserId(Auth::id())->sum('price');
        return view('pages.uang-keluar.index', compact('countPrice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.uang-keluar.create', [
            'pengeluaran'   => new Expenditure()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenditureRequest $request)
    {
        Expenditure::create([
            'user_id'   => Auth::id(),
            'price'     => $request->price,
            'keterangan'    => $request->keterangan
        ]);
        Alert::toast("Berhasil ditambahkan", "success");
        return redirect()->route('pengeluaran.index');
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
    public function edit(Expenditure $pengeluaran)
    {
        return view('pages.uang-keluar.edit', compact('pengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenditureRequest $request, Expenditure $pengeluaran)
    {
        $pengeluaran->update([
            'user_id'   => Auth::id(),
            'price'     => $request->price,
            'keterangan'    => $request->keterangan
        ]);
        Alert::toast("Berhasil diupdate", "success");
        return redirect()->route('pengeluaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenditure $pengeluaran)
    {
        $pengeluaran->delete();
        Alert::toast("Berhasil diupdate", "success");
        return redirect()->route('pengeluaran.index');
    }

    public function cetak()
    {
        $data['expenditures'] = Expenditure::whereUserId(Auth::id())->get();
        // $data['sumTotalPengeluaran'] = Expenditure::whereUserId(Auth::id())->get();
        $pdf = PDF::loadView('pages.uang-keluar.cetak', $data, [], [
            'title' => 'Cetak Pengeluaran'
        ]);
        return $pdf->stream();
    }
}
