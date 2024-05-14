<?php

namespace App\Http\Controllers;

use App\Models\rekapKas_masjid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use NumberFormatter;
use Yajra\DataTables\Facades\DataTables;

class RekapKasMasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $rekap = rekapKas_masjid::query();
            return DataTables::of($rekap)
            ->addIndexColumn()
             ->addColumn('action', function ($item) {
                $button =   '
                <button type="button" onclick="hapus('.$item->id.')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                
                <button type="button" onclick="EditData('.$item->id.')" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i?</button>';
                return $button;
            })
            ->editColumn('masuk', function($masuk) {
                $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                $amount = $masuk->masuk;
                $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS,0);
                return $formatter->formatCurrency($amount,'IDR');
            })
            ->editColumn('keluar', function($keluar) {
                $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                $amount = $keluar->keluar;
                $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS,0);
                return $formatter->formatCurrency($amount,'IDR');
            })
            ->editColumn('tanggal', function($tanggal) {
                return Carbon::parse($tanggal->tanggal)->isoFormat('DD-MM-YYYY');
            })
            ->make();
        }
          $data = [
            'title' => 'Rekap Kas Masjid'
        ];
        return view('rekapKas_masjid.index',$data);
    }

     public function saldo_pemasukan(){
        
         $saldo = rekapKas_masjid::sum('masuk');

         return response()->json(['saldo' => $saldo]);

    }

     public function saldo_pengeluaran(){
        
         $saldo = rekapKas_masjid::sum('keluar');

         return response()->json(['saldo' => $saldo]);

    }

    public function saldo_akhir(){
        
         $masuk = rekapKas_masjid::sum('masuk');
         $keluar = rekapKas_masjid::sum('keluar');

         $saldo = $masuk - $keluar;

         return response()->json(['saldo' => $saldo]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(rekapKas_masjid $rekapKas_masjid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rekapKas_masjid $rekapKas_masjid)
    {
         $rekapKas_masjid = rekapKas_masjid::find($rekapKas_masjid->id);

        if ($rekapKas_masjid) {
             return response()->json(
            [
                'status' => 200,
                'data' => $rekapKas_masjid
            ]
        );
        }else{
             return response()->json(
            [
                'status' => 404,
                'message' => 'Data tidak ditemukan'
            ]
        );
        }
    }

    /**
     * Update the specified resource in storage.
     */
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rekapKas_masjid $rekapKas_masjid)
    {
        
        $id_rekap = rekapKas_masjid::find($rekapKas_masjid->id); 
        $id_rekap->delete(); 

        return response()->json(
            [
                'success' => true,
                'message' => "Data Berhasil Dihapus",
            ]
        );
    
    }
}
