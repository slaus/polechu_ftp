<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Form\ContactFormRequest;
use App\Http\Requests\Web\Form\FeedbackFormRequest;
use App\Notifications\ContactFormNotification;
use App\Notifications\FeedbackFormNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class FormController extends Controller
{
    public function feedback(FeedbackFormRequest $request): JsonResponse
    {
        try {
            $payload = $request->validated();

            Notification::route('mail', settings('emails.request_form', config('mail.from.address')))
                ->notify(new FeedbackFormNotification($payload));

            return response()->json(['status' => 'success']);
        } catch (\Exception $exception) {
            Log::error('Error send feedback form notification.' . $exception->getMessage());
        }

        return response()->json(['status' => 'error']);
    }

    public function contact(ContactFormRequest $request): JsonResponse
    {
        try {
            $payload = $request->validated();

            Notification::route('mail', settings('emails.contact_form', config('mail.from.address')))
                ->notify(new ContactFormNotification($payload));

            return response()->json(['status' => 'success']);
        } catch (\Exception $exception) {
            Log::error('Error send contact form notification.' . $exception->getMessage());
        }

        return response()->json(['status' => 'error']);
    }
}
