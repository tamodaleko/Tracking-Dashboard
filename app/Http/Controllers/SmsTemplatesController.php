<?php

namespace App\Http\Controllers;

use App\Http\Requests\SmsTemplate\UpdateSmsTemplateTextRequest;
use App\Models\Sms\SmsTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SmsTemplatesController extends Controller
{
    public function index(Request $request): View
    {
        $templates = $request->user()->company->smsTemplates()->latest()->get();

        return view('sms-templates.index', compact('templates'));
    }

    public function updateText(SmsTemplate $template, UpdateSmsTemplateTextRequest $request): RedirectResponse
    {
        $template->update(['text' => trim($request->text)]);

        return redirect()->route('smsTemplates.index')
                ->withSuccess('Tekst SMS poruke je uspešno sačuvan.');
    }
}
