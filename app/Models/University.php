<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Point;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory;
    protected $primaryKey = 'uni_id';

    protected $fillable = ['name', 'img_url'];

    public function events()
    {
        return $this->hasMany(Event::class, 'winner_uni_id');
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }
    static public function getUniversities()
    {
        //Get All  Universities
        return DB::table('universities')->get();
    }
    static public function getSingleRecord($id)
    {
        return self::find($id);
    }
    static public function getRecord($id, $columns = ['*'])
    {
        return self::select($columns)->find($id);
    }

}
