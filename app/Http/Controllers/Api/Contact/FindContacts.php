<?php

namespace App\Http\Controllers\Api\Contact;

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

        $query = User::whereRaw("name ilike '%'||:search||'%'", ['search' => $request->search]);

        if ($contacts) {
            $query->whereRaw('id not in (' . $contacts .')');
        }

        return $query->limit(50)
            ->get()
            ->map(function (User $contact) {
                return ContactResource::make($contact)->toArray(request());
            })
            ->groupBy(function (array $contact) {
                return substr($contact['name'], 0, 1);
            });
    }
}
