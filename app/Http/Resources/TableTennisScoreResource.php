<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TableTennisScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $init_arr = [$this->set1_marks, $this->set2_marks, $this->set3_marks, $this->set4_marks, $this->set5_marks, $this->set6_marks, $this->set7_marks];
        $sets = [];
        foreach($init_arr as $i => $v) {
            if($v == -1){
                break;
            }else{
                array_push($sets, $v);
            }
        }

        return [
            "score_id"=> $this->score_id,
            "event_id"=> $this->event_id,
            "university_id"=>$this->university_id,
            "sets_won"=> $this->sets_won,
            "sets_lost"=> $this->sets_lost,
            "score_sets"=> $sets,
            "points"=> $this->points,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            "team_name"=> $this->team_name,
            "team_img_url"=> $this->team_img_url
        ];
    }
}
