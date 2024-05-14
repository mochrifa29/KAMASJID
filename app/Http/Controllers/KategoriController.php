<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
             if (request()->ajax()) {
            $kategori = Kategori::query();
            return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                $button =   '
                <button type="button" onclick="hapus('.$item->id.')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                
                <button type="button" onclick="EditData('.$item->id.')" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i?</button>';
                return $button;
            })
            ->make();
        }
        
        $data = [
            'title' => 'Kategori',
        ];
        return view('kategori.index',$data);
    }


    public function tampildata()
    {
        $data = Kategori::all();
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
            'kategori_kas' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($validator->errors(),422);
        }

        $kategori = Kategori::create([
            'kategori' => $request->kategori_kas
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => "Data Berhasil Ditambahkan",
                'data' => $kategori
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $kategori = Kategori::find($kategori->id);

        if ($kategori) {
             return response()->json(
            [
                'status' => 200,
                'data' => $kategori
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'kategori_kas' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($validator->errors(),422);
        }

        $kategori = Kategori::find($id);
        
             $kategori->kategori = $request->kategori_kas;
          $kategori->update();
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
    public function destroy(Kategori $kategori)
    {
        $kategori_id = Kategori::find($kategori->id); 
        $kategori_id->delete(); 

         return response()->json(
            [
                'success' => true,
                'message' => "Data Berhasil Dihapus",
            ]
        );
    }
}
