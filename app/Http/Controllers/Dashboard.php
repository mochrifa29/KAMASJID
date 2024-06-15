<?php

namespace App\Http\Controllers;

use App\Models\rekapKas_masjid;
use Carbon\Carbon;
use Illuminate\Http\Request;


class Dashboard extends Controller
{
    public function index(){


        $data = [
            'title' => 'Dashboard',
            'saldo_masuk' => $this->saldo_pemasukan(),
            'saldo_keluar' => $this->saldo_pengeluaran(),
           
        ];

        return view('dashboard.index',$data);
    }

      public function bulan(){
    
    }

    public function saldo_pemasukan(){
        
         $saldo = rekapKas_masjid::sum('masuk');

         return $saldo;

    }

      public function saldo_pengeluaran(){
        
         $saldo = rekapKas_masjid::sum('keluar');

         return $saldo;

    }

    

}
