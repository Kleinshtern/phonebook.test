<?php

namespace App\Http\Controllers\Phonebook;

use App\Http\Controllers\Controller;
use App\Models\Phonebook\ContactNumber;
use App\Services\PhonebookService;

class FavoriteController extends Controller
{
    public function __construct(
        protected PhonebookService $phonebookService
    ) {}

    public function markFavorite(ContactNumber $contact): bool
    {
        return $this->phonebookService->markContactAsFavorite($contact);
    }

    public function unmarkFavorite(ContactNumber $contact): bool
    {
        return $this->phonebookService->unmarkContactAsFavorite($contact);
    }
}
