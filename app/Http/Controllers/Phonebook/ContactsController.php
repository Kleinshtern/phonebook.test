<?php

namespace App\Http\Controllers\Phonebook;

use App\Http\Controllers\Controller;
use App\Http\Requests\Phonebook\CreateContactRequest;
use App\Http\Requests\Phonebook\EditContactRequest;
use App\Http\Resources\Phonebook\ContactNumberResource;
use App\Http\Resources\Phonebook\ContactNumberTableResource;
use App\Models\Phonebook\ContactNumber;
use App\Services\PhonebookService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ContactsController extends Controller
{
    public function __construct(
        protected PhonebookService $phonebookService
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection|array|null
    {
        return [
            'phoneNumbers' => ContactNumberTableResource::collection($this->phonebookService->getAllNumbers())
                ->resolve(),
            'favoriteNumbers' => ContactNumberTableResource::collection($this->phonebookService->getFavoriteNumbers())
                ->resolve()
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateContactRequest $request): Response
    {
        if($values = $request->validated()) {
            $contact = $this->phonebookService->createContact($values);

            return response(new ContactNumberResource($contact), ResponseAlias::HTTP_CREATED);
        }

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactNumber $contact): Application|Response|ResponseFactory
    {
        return response(new ContactNumberResource($contact), ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditContactRequest $request, ContactNumber $contact): Application|Response|ResponseFactory
    {
        if($values = $request->validated()) {
            return response(new ContactNumberResource($this->phonebookService->updateContact($values, $contact)));
        }

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactNumber $contact): ?bool
    {
        return $this->phonebookService->deleteContact($contact);
    }
}
