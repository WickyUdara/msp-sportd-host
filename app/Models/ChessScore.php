<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChessScore extends Model
{
    use HasFactory;

    protected $primaryKey = 'score_id';

    protected $fillable = [
        'event_id',
        'university_id',
        'match_1_score',
        'match_2_score',
        'match_3_score',
        'match_4_score',
        'match_5_score',
        'match_6_score',
        'total_score',
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
