<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->user->name,
            'type' => $this->type,
            'name' => $this->name,
            'number' => $this->number,
            'mobile' => $this->mobile,
            'fax' => $this->fax,
            'auth_email' => $this->user->email,
            'company_email' => $this->email,
            'address' => $this->address,
            'address2' => $this->address2,
            'city' => $this->city,
            'stats' => $this->stats,
            'logo' => $this->logo,
            'organisations_nr' => $this->organisations_nr,
            'note' => $this->note,
            'subscribe_code' => $this->subscribe_code,
            'package' => $this->package,
            'website' => $this->website,
            'status' => $this->status, 
        ];
    }
}