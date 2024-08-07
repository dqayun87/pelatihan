<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $tables='tasks';//ambil dr data base
    protected $primaryKey='id';
    protected $fillable=['nama','description','category_id','image'];//kolom yang boleh di isi

    public function category()//penamaan terserah
    {
        return $this->belongsTo(Category::class);// satu task hanya mmiliki 1 jkategori
        //$this menunjukkan sebuah objek(atribut atau fungsi)
    }
}
