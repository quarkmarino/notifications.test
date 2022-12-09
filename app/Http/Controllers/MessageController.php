<?php

namespace App\Http\Controllers;

use App\Enums\CategoryEnum;
use App\Http\Requests\MessageRequest;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(MessageRequest $request)
    {
        $message = new Message([
            'content' => $request->content,
            'category' => $request->category
        ]);

        return $message->save()
            ? response(['message' => __('notifications.events.created.success')], 201)
            : abort(['message' => __('notifications.events.created.failure')], 500);
    }
}
