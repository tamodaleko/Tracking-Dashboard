<?php

namespace App\Http\Controllers;

use App\Models\Sms\SmsMessage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SmsMessagesController extends Controller
{
    public function index(Request $request): View
    {
        $messages = $request->user()->company->smsMessages()->latest()->get();

        return view('sms-messages.index', compact('messages'));
    }
}
