<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadRaceScore extends Model
{
    use HasFactory;

    protected $table = 'road_race_scores';
    protected $primaryKey = 'score_id';

    protected $fillable = [
        'event_id',
        'university_id',
        'place',
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id', 'uni_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
}
