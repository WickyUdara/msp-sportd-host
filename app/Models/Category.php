<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Point;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $table = 'categories';

    protected $fillable = ['name'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }
    static public function getCategories()
    {
        return DB::table('categories')->get();
    }
    static public function getSingleRecord($id)
    {
        return self::find($id);
    }
}
