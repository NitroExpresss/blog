<?php

namespace App\Services;

use App\Repositories\ContactsRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;

class ContactsService
{
    protected $contactsRepository;

    public function __construct(ContactsRepository $contactsRepository)
    {
        $this->contactsRepository = $contactsRepository;
    }

    public function submitContactForm(array $data)
    {

        $contactMessage = $this->contactsRepository->saveContactMessage($data);
        
        // Mail::to('robertgibizov@gmail.com')->send(new ContactFormSubmitted($contactMessage));

        return $contactMessage;
    }
}