<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Point;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sport extends Model
{
    use HasFactory;
    protected $primaryKey = 'sport_id';

    protected $fillable = ['name'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }
    static public function getSports()
    {
        //Get All Sports
        return DB::table('sports')->get();
    }
    static public function getSingleRecord($id)
    {
        return self::find($id);
    }
}
