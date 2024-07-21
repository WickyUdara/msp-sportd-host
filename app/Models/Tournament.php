<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tournament extends Model
{
    use HasFactory;
    protected $primaryKey = 'tournament_id';

    protected $fillable = ['name',];

    public function tournaments()
    {
        return $this->hasMany(Event::class);
    }
    static public function getTournaments()
    {
        //Get All Tournaments
        return DB::table('tournaments')->orderBy('tournament_id', 'desc')->get();
    }
    static public function getSingleRecord($id)
    {
        return self::find($id);
    }
}
