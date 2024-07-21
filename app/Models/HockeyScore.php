<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HockeyScore extends Model
{
    use HasFactory;
    protected $table = 'hockey_scores';
    protected $primaryKey = 'score_id';

    protected $fillable = [
        'event_id',
        'university_id',
        'goals',
        'shots',
        'circle_penetrations',
        'penalty_corners',
        'green_cards',
        'yellow_cards',
        'red_cards',
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
