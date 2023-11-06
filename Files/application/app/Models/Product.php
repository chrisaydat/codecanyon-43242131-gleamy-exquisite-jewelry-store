<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function producutImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }

    public function statusBadge($status){
        $html = '';
        if($this->status == 1){
            $html = '<span class="badge badge--success">'.trans('Active').'</span>';
        }else{
            $html = '<span class="badge badge--warning">'.trans('Inactive').'</span>';
        }

        return $html;
    }

    public function scopeFilter($query ,array $filters){

        $query->when($filters['search'] ?? false, fn($query , $search)=>
        $query->where('name','like','%'.$search.'%'));
    }

}
