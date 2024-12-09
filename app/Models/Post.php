<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Post extends Model
{ 
    
    use HasFactory;
    // protected $fillable = ['title', 'excerpt', 'body', 'slug', 'category_id','id','user_id','thumbnail'];
    protected $fillable = ['title', 'excerpt', 'body', 'slug', 'category_id','id','user_id','image_url', 'latitude', 'longitude'];

    // 
    protected $with=['category','author'];
   
    
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    

    
  
}
