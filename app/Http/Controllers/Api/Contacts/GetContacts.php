<?php

namespace App\Http\Controllers\Api\Contacts;

use App\Http\Resources\ContactResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GetContacts
{
    public function get()
    {
        return Auth::user()
            ->contacts
            ->map(function (User $contact) {
                return ContactResource::make($contact)->toArray(request());
            })
            ->groupBy(function (array $contact) {
                return substr($contact['name'], 0,1);
            });
    }
}
