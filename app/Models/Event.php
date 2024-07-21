<?php

namespace App\Models;

use App\Models\Sport;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\University;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_id';

    protected $fillable = [
        'name',
        'status',
        'livestream_link',
        'event_date',
        'winner_uni_id',
        'winning_status',
        'sport_id',
        'tournament_id',
        'category_id',
    ];

    protected $appends = ['team1_uni_id', 'team2_uni_id'];

    public function getTeam1UniIdAttribute() {
        return $this->participants[0]->uni_id;
    }

    public function getTeam2UniIdAttribute() {
        return $this->participants[1]->uni_id;
    }

    public function participants() {
        return $this->hasMany(EventParticipant::class, 'event_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function team1University()
    {
        return $this->belongsTo(University::class, 'team1_uni_id');
    }
    public function team2University()
    {
        return $this->belongsTo(University::class, 'team2_uni_id');
    }

    public function winnerUniversity()
    {
        return $this->belongsTo(University::class, 'winner_uni_id');
    }

    static public function getEvents()
    {
        return Event::all();
    }
    static public function getEvent($id)
    {
        return Event::find($id);
    }

    public function getScores($sport_class)
    {
        return $this->hasMany($sport_class, 'event_id')->get();
    }
}
