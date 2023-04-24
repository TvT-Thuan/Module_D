<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->special_validity === null) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'description' => null,
                'cost' => $this->cost,
                'available' => true,
            ];
        } else {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->format_specialvalidity,
                'cost' => $this->cost,
                'available' => strpos($this->format_specialvalidity, 'tickets') ? $this->available_ticket : $this->available_date,
            ];
        }
    }
}
