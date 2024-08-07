<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas=Task::query()
        ->with('category')
        ->paginate(5);

        return view('dashboard.tasks.index', compact('datas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();//mau munculkan data di kategori
        return view('dashboard.tasks.create',compact('categories'));//memaksukkan ke variabel categoris
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required', //form validasion laravel
            'description'=>'required',
            'category_id'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg'
        ], [
            'nama.required' => 'Nama harus diisi'//pakai translate
        ]);

        $data=$request->all();

        $data['image']=Storage::disk('public')
        ->put('task_image',$request->file('image'));

        Task::query()->create($data);//munculkan semuanya

        return to_route('tasks.index')->with('success', 'Berhasil tambah kategori');


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
        $data = Task::query()->findOrFail($id);
        $categories=Category::all();//mau munculkan data di kategori

        return view('dashboard.tasks.edit', compact('data','categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required'
            

        ], [
            'nama.required' => 'Nama harus diisi'
        ]);

        Task::query()->findOrFail($id)->update($request->all());

        return to_route('tasks.index')->with('success', 'Berhasil update task');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Task::query()->findOrFail($id)->delete();

       $task=Task::query()->findOrFail($id);
       //menghapus gambar

       Storage::disk('public')->delete($task->image);
//menghapus dari tabel
       $task->delete();


        return to_route('tasks.index')->with('success', 'Berhasil hapus kategori');

    }
}
