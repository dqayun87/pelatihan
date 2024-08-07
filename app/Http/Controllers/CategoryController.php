<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $datas=Category::query()
        ->with('tasks')
        ->paginate(5);
        //select* FROM category
        // dd($datas);
        return view('dashboard.categories.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create'   );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|min:3'
        ], [
            'kategori.required' => 'Nama harus diisi',
            'kategori.min'=>'Nama Kategori harus minimal 3 karakter'
        ]);


        //Category::query()->create($request->all());
        Category::query()->create([
            'name'=>$request->kategori//name nama tabel
        ]);


        return to_route('categories.index')->with('success', 'Berhasil tambah kategori');//pesan allen harus sama mengunkan sukses
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Category::query()->findOrFail($id);
       // $categories=Category::all();
    
    
        return view('dashboard.categories.edit', compact('data'));
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Nama harus diisi'
        ]);


        Category::query()->findOrFail($id)->update($request->all());


        return to_route('categories.index')->with('success', 'Berhasil update kategori');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            Category::query()->findOrFail($id)->delete();
        }catch(QueryException $e){
            if($e->errorInfo[1]==1451){
                return to_route('categories.index')
                ->with('error','Ojo di hapus jek digawe datane');
            }
        }
        
        //SELEC FROM category WERE id=$id
        //jika mengunkan find atau find or file wajib mengunkan id


        return to_route('categories.index')->with('success', 'Berhasil hapus kategori');
    }
}
//soft delete mengapus data yang masih bisa di gunakan, karena di argap arsip