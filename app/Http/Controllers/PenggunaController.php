<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use NumberFormatter;
use Yajra\DataTables\Facades\DataTables;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         if (request()->ajax()) {
            $pengguna = Pengguna::query();
            return DataTables::of($pengguna)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                $button =   '
                <button type="button" onclick="hapus('.$item->id.')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                
                <button type="button" onclick="edit('.$item->id.')" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i?</button>';
                return $button;
            })
            ->make();
        }

         $data = [
            'title' => 'Pengguna',
        ];
        return view('pengguna.index',$data);
    }

    
    public function tampildata()
    {
        $data = Pengguna::all();
        return response()->json($data);
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
          $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'jabatan' => 'required',
            'password' => 'required',
            'email' => 'required',
            'no_telpon' => 'required|numeric',
            'alamat' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($validator->errors(),422);
        }

        $pengguna = Pengguna::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'password' => $request->password,
            'email' => $request->email,
            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => "Data Berhasil Ditambahkan",
                'data' => $pengguna
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengguna $pengguna)
    {
         $pengguna = Pengguna::find($pengguna->id);

        if ($pengguna) {
             return response()->json(
            [
                'status' => 200,
                'data' => $pengguna
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
    public function update(Request $request, Pengguna $pengguna)
    {
         $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'jabatan' => 'required',
            'email' => 'required',
            'password' => 'required',
            'no_telpon' => 'required',
            'alamat' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($validator->errors(),422);
        }

        $pengguna = Pengguna::find($pengguna->id);
        
        $pengguna->nama = $request->nama;
        $pengguna->jabatan = $request->jabatan;
        $pengguna->password = $request->password;
        $pengguna->email = $request->email;
        $pengguna->no_telpon = $request->no_telpon;
        $pengguna->alamat = $request->alamat;
        $pengguna->update();
        return response()->json(
            [
                'status' => 200,
                'message' => 'Data Berhasil Diubah'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengguna $pengguna)
    {
        $pengguna_id = Pengguna::find($pengguna->id); 
        $pengguna_id->delete(); 

         return response()->json(
            [
                'success' => true,
                'message' => "Data Berhasil Dihapus",
            ]
        );
    }
}
