<?php

namespace App\Http\Controllers;

use App\Models\rekapKas_masjid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use NumberFormatter;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
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
            'title' => 'Laporan Kas Masjid'
        ];
        return view('laporan.index',$data);
    }
}
