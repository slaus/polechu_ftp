<?php

namespace App\Http\Controllers\Web;

use App\Enums\OrderTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Form\ContactFormRequest;
use App\Http\Requests\Web\Form\FeedbackFormRequest;
use App\Http\Requests\Web\Form\TourFormRequest;
use App\Notifications\ContactFormNotification;
use App\Notifications\FeedbackFormNotification;
use App\Notifications\TourSearchNotification;
use App\Services\Order\CommandOrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class FormController extends Controller
{
    public function feedback(FeedbackFormRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $commandService = new CommandOrderService($request->user());
        $commandService->store([
            'type' => OrderTypeEnum::SUBSCRIBE_FORM->value,
            'title' => $payload['email'],
            'content' => $payload,
        ]);

        if (settings('emails.request_form')) {
            try {
                Notification::route('mail', settings('emails.request_form'))
                    ->notify(new FeedbackFormNotification($payload));
            } catch (\Exception $exception) {
                Log::error('Error send feedback form notification.' . $exception->getMessage());

                return response()->json(['status' => 'error']);
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function contact(ContactFormRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $commandService = new CommandOrderService($request->user());
        $commandService->store([
            'type' => OrderTypeEnum::CONTACT_FORM->value,
            'title' => $payload['name'] . ' (' . $payload['email'] . ')',
            'content' => $payload,
        ]);

        if (settings('emails.contact_form')) {
            try {
                Notification::route('mail', settings('emails.contact_form'))
                    ->notify(new ContactFormNotification($payload));
            } catch (\Exception $exception) {
                Log::error('Error send contact form notification.' . $exception->getMessage());

                return response()->json(['status' => 'error']);
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function tour(TourFormRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $commandService = new CommandOrderService($request->user());
        $commandService->store([
            'type' => OrderTypeEnum::SEARCH_FORM->value,
            'title' => $payload['name'] . ' (' . $payload['email'] . ')',
            'content' => $payload,
        ]);

        if (settings('emails.search_tour_form')) {
            try {
                Notification::route('mail', settings('emails.search_tour_form'))
                    ->notify(new TourSearchNotification($payload));
            } catch (\Exception $exception) {
                Log::error('Error send tour search form notification.' . $exception->getMessage());

                return response()->json(['status' => 'error']);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
