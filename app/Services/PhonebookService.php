<?php

namespace App\Services;

use App\Models\Phonebook\ContactNumber;
use App\Traits\StorageTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

/**
 * Class PhonebookService
 *
 * @package PhonebookService
 *
 * @method ContactNumber[] getAllNumbers()
 * @method ContactNumber[] getFavoriteNumbers()
 * @method ContactNumber createContact(array $values)
 * @method ContactNumber updateContact(array $values, ContactNumber $contact)
 * @method bool deleteContact(ContactNumber $contact)
 * @method bool markContactAsFavorite(ContactNumber $contact)
 */
class PhonebookService
{
    use StorageTrait;

    public function getAllNumbers(): Collection
    {
        return ContactNumber::default()
            ->where('user_id', auth()->id())
            ->get()
            ->sortBy('full_name');
    }

    public function getFavoriteNumbers(): Collection
    {
        return ContactNumber::favorite()
            ->where('user_id', auth()->id())
            ->get()
            ->sortBy('full_name');
    }

    public function createContact(array $values): ContactNumber
    {
        $contactNumber = new ContactNumber();
        $contactNumber->user_id = auth()->id();
        $contactNumber->fill($values);

        /** @var UploadedFile $file */
        if(isset($values['avatar']) && $file = $values['avatar']) {
            $filename = time().'_'.auth()->id()."_".$contactNumber->first_name.".".$file->getClientOriginalExtension();

            if(self::uploadFile(file: $file, filename: $filename, directory: "avatars"))
            {
                $contactNumber->avatar = $filename;
            }
        }

        $contactNumber->save();

        return $contactNumber;
    }

    public function updateContact(array $values, ContactNumber $contact): ContactNumber
    {
        if(isset($values['avatar'])) {
            self::deleteFile("avatars/$contact->avatar");
        }

        $contact->fill($values);

        if(isset($values['avatar']) && $file = $values['avatar']) {
            $filename = time().'_'.auth()->id()."_".$contact->first_name;

            $file->storeAs("avatars", $filename, "public");

            $contact->avatar = $filename;
        }

        $contact->save();

        return $contact;
    }

    public function deleteContact(ContactNumber $contact): ?bool
    {
        return $contact->delete();
    }

    public function markContactAsFavorite(ContactNumber $contact): bool
    {
        $contact->is_favorite = true;
        return $contact->save();
    }

    public function unmarkContactAsFavorite(ContactNumber $contact): bool
    {
        $contact->is_favorite = false;
        return $contact->save();
    }
}
