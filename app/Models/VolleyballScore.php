<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolleyballScore extends Model
{
    use HasFactory;

    protected $primaryKey = 'score_id';


    protected $fillable = [
        'event_id',
        'university_id',
        'sets_won',
        'sets_lost',
        'current_round',
        'set1_marks',
        'set2_marks',
        'set3_marks',
        'points',
    ];

    protected $appends = ['team_name', 'team_img_url'];

    public function getTeamNameAttribute() {
        return $this->university->name;
    }

    public function getTeamImgUrlAttribute() {
        return $this->university->img_url;
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    /**
     * Get the scores that belong to a specific event.
     *
     * @param int $eventId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getScoresByEventId(int $eventId)
    {
        return self::where('event_id', $eventId)->get();
    }

}
