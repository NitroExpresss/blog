<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContactsService;

class ContactsController extends Controller
{
    protected $contactsService;

    public function __construct(ContactsService $contactsService)
    {
        $this->contactsService = $contactsService;
    }

    public function show()
    {
        return view('contacts');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $this->contactsService->submitContactForm($request->all());

        return redirect()->route('contact.show');
    }
}