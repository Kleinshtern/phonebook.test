<?php

namespace App\Http\Controllers\Phonebook;

use App\Enums\TypeNumbers;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class FormDataController extends Controller
{
    public function typeNumbers(): JsonResponse
    {
        return response()->json(TypeNumbers::getTypeNumbersDescription());
    }
}
