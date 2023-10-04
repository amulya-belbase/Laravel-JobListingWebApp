<?php

namespace App\Models;

use PDO;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'tags', 'company', 'location', 'email', 'website', 'description','logo'];


    public function scopeFilter($query, array $filters){
        // dd($filters['tag']);
        if ($filters['tag'] ?? false){
            $query -> where('tags','like','%'.request('tag').'%');
        }
        if ($filters['search'] ?? false){
            $query -> where('title','like','%'.request('search').'%')
            ->orWhere('description','like','%'.request('search').'%')
            ->orWhere('tags','like','%'.request('search').'%')
            ->orWhere('company','like','%'.request('search').'%');
        }
    }

    // relationship to the user
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}