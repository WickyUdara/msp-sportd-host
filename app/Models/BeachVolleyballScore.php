<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeachVolleyballScore extends Model
{
    use HasFactory;protected $table = 'beach_volleyball_scores';
    protected $primaryKey = 'score_id';

    protected $fillable = [
        'event_id',
        'university_id',
        'set_1_score',
        'set_2_score',
        'set_3_score',
        'round',
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
