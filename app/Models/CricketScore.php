<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CricketScore extends Model
{
    use HasFactory;

    protected $primaryKey = 'score_id';

    protected $fillable = [
        'event_id',
        'university_id',
        'runs',
        'n_6s',
        'n_4s',
        'no_balls',
        'wide_balls',
        'wickets',
        'innings',
        'points',
    ];

    protected $appends = ['balls', 'overs', 'score', 'team_name', 'team_img_url'];

    public function getBallsAttribute() {
        return $this->n_6s + $this->n_4s + $this->wickets;
    }

    public function getOversAttribute() {
        return intval($this->balls / 6);
    }

    public function getScoreAttribute() {
        return ($this->runs) + ($this->n_6s*6) + ($this->n_4s*4) + ($this->wide_balls) + ($this->no_balls);
    }

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
}
