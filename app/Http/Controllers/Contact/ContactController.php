<?php

namespace App\Http\Controllers\Contact;

use App\Helpers\{SeoHelper, SettingHelper, UtlHelper, ThemeHelper};
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\{Redirect, Validator};
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $isContactUrl = UtlHelper::isContactUrl();

        if ($isContactUrl) {
            $getCurrentLanguage = LaravelLocalization::getCurrentLocale();
            if ($getCurrentLanguage != $isContactUrl) {
                $data  = ThemeHelper::getConfigContact('magz', 'contact', 'body')['config'];
                return redirect($data['url'][$getCurrentLanguage]);
            }
            SeoHelper::getPage('contact', __('dhakawatch::magz.contact'), null, null, null, url("/contact"));
            return view(SettingHelper::activeTheme('page/contact'));
        } else {
            return Redirect::route('show', ['slug' => last(request()->segments())]);
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email',
            'subject' => 'nullable',
            'message' => 'required',
            'g-recaptcha-response' => 'sometimes|required|captcha'
        ]);

        $name = explode(" ", trim($request->name))[0];

        if ($validator->fails()) {
            return response()->json([
                'status' => 'errors',
                'data' => [
                    'title' => __('message.sent_contact_message_failed_title', ['name' => $name]),
                    'body' => $validator->errors()
                ]
            ]);
        }

        $save = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        if ($save) {
            return response()->json([
                'status' => true,
                'data' => [
                    'title' => __('message.sent_contact_message_title', ['name' => $name]),
                    'body' => __('message.your_message_has_been_sent')
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'data' => [
                    'title' => __('message.sent_contact_message_failed_title', ['name' => $name]),
                    'body' => __('message.your_message_could_not_be_sent')
                ]
            ]);
        }
    }
}
