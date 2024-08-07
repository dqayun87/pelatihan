<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $tables='categories';//ambil dr data base
    protected $primaryKey='id';
    protected $fillable=['name'];//kolom yang boleh di isi

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
