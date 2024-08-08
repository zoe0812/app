<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listings extends Model
{
    use HasFactory;
    protected $fillable=['title','company','location','website','email','description','tag'];

    public function scopefilter($query,array $fillter){
        if($fillter["tag"] ?? false){
            $query->where('tag','like','%'.request('tag','%'));
        }

        if($fillter["search"] ?? false){
            $query->where('title','like','%'.request('search').'%')
            ->orwhere('description','like','%'.request('search').'%')
            ->orwhere('tag','like','%'.request('search').'%');
        }
    }
}
