<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Country;
use App\Models\Organization;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('organization');

        if ($request->has('search')) {
            $query->where(function ($subquery) use ($request) {
                $subquery->where('first_name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('last_name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('city', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('phone', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('organization', 'like', '%' . $request->input('search') . '%');
            });
        }

        $contacts = $query->latest('id')->paginate();

        return Inertia::render('Contacts/Index', compact('contacts'));
    }

    public function create()
    {
        $organizations = Organization::all();
        $countries = Country::all();

        return Inertia::render('Contacts/Create', compact('organizations', 'countries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'organization_id' => 'required',
            'country_id' => 'required',
            'postal_code' => 'required',
        ]);

        $contact = Contact::create($data);

        return redirect()->route('contacts.index', $contact);
    }

    public function edit(Contact $contact)
    {
        $organizations = Organization::all();
        $countries = Country::all();

        return Inertia::render('Contacts/Edit', compact('contact', 'organizations', 'countries'));
    }

    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'organization_id' => 'required',
            'country_id' => 'required',
            'postal_code' => 'required',
        ]);

        $contact->update($data);

        return redirect()->route('contacts.index');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index');
    }
}
