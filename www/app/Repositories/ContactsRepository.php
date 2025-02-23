<?php
namespace App\Repositories;

use App\Models\ContactMessage;


class ContactsRepository
{
    public function saveContactMessage(array $data)
    {
        return ContactMessage::create($data);
    }
}