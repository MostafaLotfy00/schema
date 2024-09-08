<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;
    protected $guarded;


    public static function booted(){
        static::creating(function($model){
            if($model->sub_unit_id == null){
            $model->sell_sub_price =  0;
            }
        });

        static::updating(function($model){
            if($model->sub_unit_id == null){
                $model->sell_sub_price =  0;
                } });
    }

    public function category(){
        return $this->belongsTo(Category::class)->withDefault([
            'name' => "لا يوجد"
        ]);
    }
    public function business(){
        return $this->belongsTo(Business::class)->withDefault([
            'name' => "لا يوجد"
        ]);
    }
    public function brand(){
        return $this->belongsTo(Brand::class)->withDefault([
            'name' => "لا يوجد"
        ]);
    }
    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id')->withDefault([
            'name' => "لا يوجد"
        ]);
    }
    public function subUnit(){
        return $this->belongsTo(Unit::class,'sub_unit_id', 'id')->withDefault([
            'name' => "لا يوجد"
        ]);
    }

    #Filter Scope
    public function scopeFilter(Builder $builder, $filters){

        $builder->when($filters['name'] ?? false, function($query, $value){
            $query->where('name', 'LIKE', "%{$value}%");
        });
        $builder->when($filters['category_id'] ?? false, function($query, $value){
            $query->where('category_id', $value);
        });
        $builder->when($filters['brand_id'] ?? false, function($query, $value){
            $query->where('brand_id', $value);
        });
        $builder->when($filters['business_id'] ?? false, function($query, $value){
            $query->where('business_id', $value);
        });
        $builder->when($filters['unit_id'] ?? false, function($query, $value){
            $query->where('unit_id', $value);
        });
    
    }
    #ACCESSORS
    public function getImageUrlAttribute(){
        if(!$this->image){
            return 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1200px-No-Image-Placeholder.svg.png';
        }

        if(Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return asset('uploads/'. $this->image);
    }
}
