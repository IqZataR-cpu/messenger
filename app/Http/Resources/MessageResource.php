<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * @property Message $resource
 */
class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'text' => $this->resource->text,
            'date' => $this->resource->isEdited()
                ? $this->resource->updated_at->format('h:i')
                : $this->resource->created_at->format('h:i'),
            'created_at' => $this->resource->created_at->format('m/d/Y'),
            'is_edited' => $this->resource->isEdited(),
            'is_mine' => $this->resource->user->is(Auth::user()),
            'user' => $this->whenLoaded('user'),
            'attachment' => $this->whenLoaded('attachment'),
            'statuses' => $this->whenLoaded('statuses'),
        ];
    }
}
