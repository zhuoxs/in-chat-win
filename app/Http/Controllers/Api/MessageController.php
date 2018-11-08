<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\MessageRequest;
use App\Message;
use App\Settings;
use App\Transformers\MessageTransformer;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function store(MessageRequest $request)
    {
        $user = $this->user();

        $data = $request->all();
        $data['user_id'] = $user->id;

        $item = Message::create($data);

        return $this->response->item($item , new MessageTransformer());
    }

    public function update(MessageRequest $request , Message $message)
    {
        $user = $this->user();

        if ($user->id != $message->user_id){
            return $this->response->errorUnauthorized();
        }

        $message->fill($request->all());
        $message->save();

        return $this->response->item($message , new MessageTransformer());
    }

    public function destroy($ids)
    {
        $user = $this->user();

        Message::where('user_id' , $user->id)
            ->whereIn('id' , explode(',' , $ids))
            ->delete();

        return $this->response->noContent();
    }

    public function index(MessageRequest $request , Settings $settings)
    {
        $user = $this->user();

        if ($settings->user_id != $user->id) {
            return $this->response->errorUnauthorized();
        }

        $items = Message::where('user_id' , $user->id)
            ->where('setting_id' , $settings->id)
            ->paginate($request->get('paginate' , 20));

        return $this->response->paginator($items , new MessageTransformer());
    }

    public function show(Settings $settings , Message $message)
    {
        $user = $this->user();

        if ($user->id != $settings->user_id) {
            return $this->response->errorUnauthorized();
        }

        return $this->response->item($message , new MessageTransformer());
    }

}
