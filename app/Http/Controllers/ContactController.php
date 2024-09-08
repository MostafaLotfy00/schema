<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts= Contact::paginate(10);
        return view('contacts.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'unique:contacts,email'
        ]);
        Contact::create($request->all());
        return to_route('contacts.index')->with('success', 'تم اضافة جهة اتصال بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $Contact)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', ['contact' => $contact]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
         $request->validate([
          'email' => 'unique:users,email,' . $contact->id
        ]);
        $contact->update($request->all);
        return to_route('contats.index')->with('success', 'تم تعديل جهة اتصال بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return to_route('contacts.index')->with('success', 'تم حذف جهة اتصال بنجاح');
    }
}
