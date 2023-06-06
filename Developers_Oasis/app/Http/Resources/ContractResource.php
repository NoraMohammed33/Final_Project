<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'user_id' =>  new UserResource($this->user),
            'service_id' => new ServiceResource($this->service),
            'expert_id' => new ExpertResource($this->expert),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
