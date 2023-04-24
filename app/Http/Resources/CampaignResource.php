<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public function toArray($request)
    {
        if(!$request->organizer_slug){
            return [
                'id' => $this->id,
                'name' => $this->name,
                'slug' => $this->slug,
                'date' => $this->format_date,
                'organizer' => new UserResource($this->Users),
            ];
        }
        else{
            return [
                'id' => $this->id,
                'name' => $this->name,
                'slug' => $this->slug,
                'date' => $this->format_date,
                'areas' => AreaResource::collection($this->Areas),
                'tickets' => TicketResource::collection($this->Tickets),
            ];
        }
    }
}
