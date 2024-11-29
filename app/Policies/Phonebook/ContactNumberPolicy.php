<?php

namespace App\Policies\Phonebook;

use App\Models\Phonebook\ContactNumber;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContactNumberPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ContactNumber $contactNumber): bool
    {
        return $user->id == $contactNumber->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ContactNumber $contactNumber): bool
    {
        return $user->id == $contactNumber->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContactNumber $contactNumber): bool
    {
        return $user->id == $contactNumber->user_id;
    }
}
