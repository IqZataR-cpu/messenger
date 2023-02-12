<?php

namespace App\Http\Controllers\Api\Contacts;

use App\Http\Resources\ContactResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FindContacts
{
    public function get(Request $request)
    {
        if (!$request->search) {
            return response()->json();
        }

        $contacts = Auth::user()->contacts()->get(['users.id'])->pluck('id')->implode(',');

        return User::whereRaw("name ilike '%'||:search||'%'", ['search' => $request->search])
            ->whereRaw('id not in (' . $contacts .')')
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
