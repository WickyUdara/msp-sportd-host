<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaekwondoScore extends Model
{
    use HasFactory;

    protected $primaryKey = 'score_id';

    protected $fillable = [
        'event_id',
        'university_id',
        'score',
        'penalty',
        'round',
    ];

    public function university() {
        return $this->belongsTo(University::class, 'university_id', 'uni_id');
    }

    public function event() {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
}
