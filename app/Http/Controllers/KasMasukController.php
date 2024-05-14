<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\rekapKas_masjid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use NumberFormatter;
use Yajra\DataTables\Facades\DataTables;

class KasMasukController extends Controller
{
   
    public function index()
    {
       if (request()->ajax()) {
            $rekap = rekapKas_masjid::query()->where('status','=',1);
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
             ->editColumn('tanggal', function($tanggal) {
                return Carbon::parse($tanggal->tanggal)->isoFormat('DD-MM-YYYY');
            })
            ->make();
        }

        
        $data = [
            'title' => 'Kas Pemasukan',
            'kategori' => Kategori::all()
        ];
        return view('kas_masjid.kas_masuk.index',$data);
    }

    public function saldo_pemasukan(){
        
         $saldo = rekapKas_masjid::sum('masuk');

         return response()->json(['saldo' => $saldo]);

    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_kategori' => 'required',
            'uraian' => 'required',
            'masuk' => 'required|numeric',
            'tanggal' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($validator->errors(),422);
        }

       $rekap = rekapKas_masjid::create([
            'id_kategori' => $request->id_kategori,
            'uraian' => $request->uraian,
            'tanggal' => $request->tanggal,
            'masuk' => $request->masuk,
            'keluar' => 0,
            'status' => 1
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => "Data Berhasil Ditambahkan",
                'data' => $rekap
            ]
        );
    }
     
   public function update_kas_masuk(Request $request, $id)
    {
         $validator = Validator::make($request->all(),[
            'id_kategori' => 'required',
            'uraian' => 'required',
            'masuk' => 'required|numeric',
            'tanggal' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($validator->errors(),422);
        }

        $rekap = rekapKas_masjid::find($id);
        
        $rekap->id_kategori = $request->id_kategori;
        $rekap->uraian = $request->uraian;
        $rekap->masuk = $request->masuk;
        $rekap->tanggal = $request->tanggal;
          
          $rekap->update();
          return response()->json(
            [
                'status' => 200,
                'message' => 'Data Berhasil Diubah'
            ]
        );
    }

  

     
  
}
