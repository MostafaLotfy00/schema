<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded;


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
