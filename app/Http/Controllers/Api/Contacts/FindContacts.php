<?php

namespace App\Http\Controllers\Api\Contacts;

use App\Http\Resources\ContactResource;
use App\Models\User;
use Illuminate\Http\Request;

class FindContacts
{
    public function get(Request $request)
    {
        if (!$request->search) {
            return response()->json();
        }

        return User::whereRaw("name ilike '%'||?||'%'", $request->search)
            ->limit(50)
            ->get()
            ->map(function (User $contact) {
                return ContactResource::make($contact)->toArray(request());
            })
            ->groupBy(function (array $contact) {
                return substr($contact['name'], 0, 1);
            });
    }
}
