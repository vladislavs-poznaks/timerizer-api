<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SetResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'rounds' => $this->rounds,
            'total_seconds' => $this->total_seconds,
            'work_seconds' => $this->work_seconds,
            'rest_seconds' => $this->rest_seconds,
            'round_seconds' => $this->round_seconds,
//            'createdAt' => $this->created_at,
//            'updatedAt' => $this->updated_at,
        ];
    }
}
