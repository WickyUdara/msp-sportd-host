<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwimmingScore extends Model
{
    use HasFactory;

    protected $primaryKey = 'score_id';

    protected $fillable = [
        'event_id',
        'university_id',
        'place',
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
}
