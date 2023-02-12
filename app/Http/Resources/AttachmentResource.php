<?php

namespace App\Http\Resources;

use App\Models\Attachment;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Attachment $resource
 */
class AttachmentResource extends JsonResource
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
            'link' => $this->resource->link,
            'created_at' => $this->resource->created_at->toDateTimeString(),
        ];
    }
}
