<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabaddiScore extends Model
{
    use HasFactory;

    protected $primaryKey = 'score_id';

    protected $fillable = [
        'event_id',
        'uni_id',
        'raid_points',
        'bonus_points',
        'tackle_points',
        'all_out_points',
        'total_score',
    ];

    public function university() {
        return $this->belongsTo(University::class, 'uni_id', 'uni_id');
    }

    public function event() {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
}
