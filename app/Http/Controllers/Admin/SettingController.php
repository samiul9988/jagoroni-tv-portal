<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MagzExport;
use App\Helpers\{AnalyticHelper};
use App\Http\Controllers\Controller;
use App\Imports\MagzImport;
use App\Models\{Language, User};
use App\Services\SettingService;
use GeoSot\EnvEditor\Facades\EnvEditor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\{Arr, Str};
use Illuminate\Support\Facades\{App, Auth, Cache, File, Redirect, Session, Validator};
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Analytics\Period;
use ZipArchive;

class SettingController extends Controller
{
    private $settingService;

    /**
     * __construct
     *
     * @param  mixed $settingService
     * @return void
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;

        $this->middleware('permission:read-settings', ['only' => ['index', 'setting']]);
        $this->middleware('permission:update-settings', [
            'only' => ['updateSettings', 'changeMaintenance', 'changeRegisterMember', 'changeActiveEmailVerification', 'settingUpdate']
        ]);
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $dir                   = config('settings.current_theme_dir');
        $maintenance           = config('settings.maintenance')              === 'y' ? 'checked' : '';
        $register              = config('settings.register')                 === 'y' ? 'checked' : '';
        $emailVerification     = config('settings.email_verification')       === 'y' ? 'checked' : '';
        $showLanguage          = config('settings.display_language')         === 'y' ? 'checked' : '';
        $links                 = json_decode(config('settings.links'));
        $commentApproval       = config('settings.comment_approval')         === 'y' ? 'checked' : '';
        $sendCommentReplyEmail = config('settings.send_comment_reply_email') === 'y' ? 'checked' : '';

        $creditFooter = File::get(resource_path('views/frontend/' . $dir . '/inc/_credit-footer.blade.php'));

        $languages = Language::select('name', 'language', 'active')->where('active', 'y')->pluck('name', 'language');

        $currentLanguage = Language::select('language')->find(Auth::user()->language)->language;

        $propertyId =  EnvEditor::getKey("ANALYTICS_PROPERTY_ID");

        $logoWebLight  = $this->settingService->getAssetImage(config('settings.logo_web_light'));
        $logoWebDark   = $this->settingService->getAssetImage(config('settings.logo_web_dark'));
        $favicon       = $this->settingService->getAssetImage(config('settings.favicon'));
        $ogiHomepage   = $this->settingService->getAssetImage(config('settings.ogi_homepage'));
        $logoDashboard = $this->settingService->getAssetImage(config('settings.logo_dashboard'));
        $logoAuth      = $this->settingService->getAssetImage(config('settings.logo_auth'));

        $numberNestedComments = [2,3,4,5,6,7,8,9,10];

        return view('admin.settings.index', compact(
            'propertyId',
            'creditFooter',
            'favicon',
            'languages',
            'currentLanguage',
            'logoAuth',
            'logoDashboard',
            'logoWebLight',
            'logoWebDark',
            'maintenance',
            'ogiHomepage',
            'register',
            'emailVerification',
            'commentApproval',
            'sendCommentReplyEmail',
            'numberNestedComments',
            'showLanguage',
            'links'
        ));
    }

    /**
     * @return Application|SessionManager|Store|mixed
     */
    public function sessionDeviceSetPeriode()
    {
        $period  = (int)request('periode');
        $devices = AnalyticHelper::getTopDevice(Period::days((int)request('periode')))->toArray();
        $num_col = $devices ? count($devices) : 12;
        $col     = 12 / $num_col;

        return [
            'period' => AnalyticHelper::getLabel($period),
            'data'   => $devices,
            'col'    => $col
        ];
    }

    /**
     * @return Application|SessionManager|Store|mixed
     */
    public function visitorPageViewSetPeriode()
    {
        $period  = request('periode');

        $totalVP  = AnalyticHelper::fetchTotalVisitorsAndPageViews(Period::days($period));
        $dates_VP = $totalVP->map(function ($item) {
            return $item['date']->format('d M');
        })->toArray();

        $visitors_VP    = $totalVP->pluck('activeUsers');
        $pageViews_VP   = $totalVP->pluck('screenPageViews');
        $totalPageViews = $totalVP->sum('screenPageViews');
        $totalVisitors  = $totalVP->sum('activeUsers');

        $chart = [
            'chart' => [
                'labels' => Arr::flatten($dates_VP),
            ],
            'datasets' => [
                [
                    'name' => 'Visitors',
                    'values' => Arr::flatten($visitors_VP),
                ],
                [
                    'name' => 'PageViews',
                    'values' => Arr::flatten($pageViews_VP),
                ]
            ],
            'period' => AnalyticHelper::getLabel($period),
            'total' => [
                'totalPageViews' => $totalPageViews,
                'totalVisitors' => $totalVisitors
            ]
        ];

        return $chart;
    }

    /**
     * @return Application|SessionManager|Store|mixed
     */
    public function mostVisitedPages()
    {
        return session(['session_most_visited_pages' => (int)request('periode')]);
    }

    /**
     * @return Application|SessionManager|Store|mixed
     */
    public function browserUsed()
    {
        return session(['session_browser_used' => (int)request('periode')]);
    }

    /**
     * @return Application|SessionManager|Store|mixed
     */
    public function operatingSystem()
    {
        return session(['session_browser_used' => (int)request('periode')]);
    }

    /**
     * @return Application|SessionManager|Store|mixed
     */
    public function sessionsCountry()
    {
        return session(['session_country' => (int)request('periode')]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function changeDashboardLanguage(Request $request)
    {
        Cache::forget('settings');
        return User::find(Auth::id())->update(['language' => request('id')]);
    }

    /**
     * @param $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeCurrentUserLanguage($lang)
    {
        Cache::forget('settings');
        User::find(Auth::id())->update(['language' => $lang]);
        return Redirect::back();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeDefaultLanguage(Request $request): JsonResponse
    {
        Cache::forget('settings');
        App::setLocale(request('code'));
        Session::put('locale', request('code'));
        LaravelLocalization::setLocale(request('code'));

        $this->settingService->modify('default_language', request('code'));

        return response()->json(['success' => __('message.saved_successfully')]);
    }

    /**
     * changeCommentReqApproval
     *
     * @param  mixed $request
     * @return void
     */
    public function changeCommentReqApproval(Request $request)
    {
        Cache::forget('settings');

        $this->settingService->modify('comment_approval', $request->active);

        $msg = $request->active === 'y' ?
            __('message.comment_approval_enabled') : __('message.comment_approval_disabled');

        return response()->json(['success' => $msg]);
    }

    /**
     * changeSendCommentReplyEmail
     *
     * @param  mixed $request
     * @return void
     */
    public function changeSendCommentReplyEmail(Request $request)
    {
        Cache::forget('settings');

        $this->settingService->modify('send_comment_reply_email', $request->active);

        $msg = $request->active === 'y' ?
            __('message.send_comment_reply_email_enabled') : __('message.send_comment_reply_email_disabled');

        return response()->json(['success' => $msg]);
    }

    /**
     * changeCommentReqApproval
     *
     * @param  mixed $request
     * @return void
     */
    public function changeNumNestedComment(Request $request)
    {
        Cache::forget('settings');

        $this->settingService->modify('number_nested_comments', request('number_nested_comments'));

        $msg = request('number_nested_comments') === 'y' ?
            __('message.saved_successfully') : __('message.saved_successfully');

        return response()->json(['success' => $msg]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeMaintenance(Request $request)
    {
        Cache::forget('settings');

        $this->settingService->modify('maintenance', request('active'));

        $msg = request('active') === 'y' ?
            __('message.mode_maintenance_enabled') : __('message.mode_maintenance_disabled');

        return response()->json(['success' => $msg]);
    }

    /**
     * setConfig
     *
     * @param  mixed $request
     * @return void
     */
    public function setConfig(Request $request)
    {
        Cache::forget('settings');

        if ($request->key == 'permalink_type') {
            if ($request->value == 'custom') {
                $this->settingService->modify('permalink', $request->custom);
                $this->settingService->modify('permalink_old_custom', $request->custom);
            } else {
                $this->settingService->modify('permalink', $request->value);
                $this->settingService->modify('permalink_old_custom', config('settings.permalink_old_custom'));
            }
        }

        $this->settingService->modify($request->key, $request->value);

        $msg =  __('message.changed_successfully');

        return response()->json(['success' => $msg]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeRegisterMember(Request $request)
    {
        Cache::forget('settings');


        $currentUser = Auth::User();

        if(!$currentUser->hasRole(['super-admin', 'admin'])) {
            return response()->json(['abort' => __('message.unauthorized_action')]);
        }

        $this->settingService->modify('register', request('active'));

        $msg = request('active') === 'y' ?
            __('message.register_enabled') : __('message.register_disabled');

        return response()->json(['success' => $msg]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeActiveEmailVerification(Request $request)
    {
        Cache::forget('settings');
        if(!Auth::User()->hasRole(['super-admin', 'admin'])) {
            return response()->json(['abort' => __('message.unauthorized_action')]);
        }

        $this->settingService->modify('email_verification', request('active'));

        if (request('active') === 'y') {
            $msg = __('message.email_verification_enabled');
        } else {
            $msg = __('message.email_verification_disabled');
        }

        return response()->json(['success' => $msg]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeDisplayLanguage(Request $request): JsonResponse
    {
        Cache::forget('settings');
        $this->settingService->modify('display_language', request('active'));

        $msg = request('active') === 'y' ?
            __('message.display_language_enabled') : __('message.display_language_disabled');

        return response()->json(['success' => $msg]);
    }

    /**
     * @param Request $request
     * @return JsonResponse|\Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function settingUpdate(Request $request)
    {
        $this->authorize('update-settings');

        $validator = Validator::make($request->all(), [
            'company_name' => Rule::requiredIf(request()->has('web_information')),
            'site_name'    => Rule::requiredIf(request()->has('web_information')),
            'site_url'     => Rule::requiredIf(request()->has('web_information')),
            'favicon'      => 'dimensions:max_width=256,max_height=256|mimes:jpeg,png,ico',
            'logo_website' => 'dimensions:max_width=800,max_height=800|image|mimes:jpeg,png',
            'og_image'     => 'dimensions:max_width=1484,max_height=1200|image|mimes:jpeg,png'
        ]);

        if (request()->has('site_logo')) {
            if ($validator->fails()) {
                return redirect()->route('settings.index')->with('error', $validator->errors()->first());
            }
        } else {
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            }
        }

        if (request()->has('web_information')) {

            if (request('credit_footer')) {
                $dir = config('settings.current_theme_dir');
                File::put(resource_path('views/frontend/'.$dir.'/inc/_credit-footer.blade.php'), request('credit_footer'));
            }

            $arrayValues = [
                ['key' => 'company_name', 'value' => request('company_name')],
                ['key' => 'site_name', 'value' => request('site_name')],
                ['key' => 'site_url', 'value' => request('site_url')],
                ['key' => 'site_description', 'value' => request('site_description')],
                ['key' => 'meta_keyword', 'value' => request('meta_keyword')],
            ];

            Cache::forget('settings');

            foreach ($arrayValues as $value) {
                $this->settingService->modify($value['key'], $value['value']);
            }

            return response()->json(['success' => __('message.saved_successfully')]);
        }

        if (request()->has('web_contact')) {
            $arrayValues = [
                ['key' => 'street', 'value' => request('street')],
                ['key' => 'city', 'value' => request('city')],
                ['key' => 'postal_code', 'value' => request('postal_code')],
                ['key' => 'state', 'value' => request('state')],
                ['key' => 'country', 'value' => request('country')],
                ['key' => 'site_phone', 'value' => request('site_phone')],
                ['key' => 'site_email', 'value' => request('site_email')],
                ['key' => 'contact_description', 'value' => json_encode(request('contact_description'))]
            ];

            Cache::forget('settings');

            foreach ($arrayValues as $value) {
                $this->settingService->modify($value['key'], $value['value']);
            }

            return response()->json(['success' => __('message.saved_successfully')]);
        }

        if (request()->has('site_logo')) {

            Cache::forget('settings');

            if (request()->hasFile('favicon')) {
                $getFileName      = pathinfo(request()->favicon->getClientOriginalName(), PATHINFO_FILENAME);
                $getFileExtension = request()->favicon->getClientOriginalExtension();

                $filename = $getFileName . '-' . Str::random(10) . '.' . $getFileExtension;

                $img = Image::make(request('favicon'));
                $resizeImage = $img->resize(32, 32);
                $img->insert($resizeImage, 'center');

                $img->save(storage_path('app/public/assets') . '/' . $filename);

                $this->settingService->modify('favicon', $filename);
            }

            if (request()->hasFile('logo_web_light')) {
                $getFileName = pathinfo(request()->logo_web_light->getClientOriginalName(), PATHINFO_FILENAME);
                $getFileExtension = request()->logo_web_light->getClientOriginalExtension();

                $filename = $getFileName . '-' . Str::random(10) . '.' . $getFileExtension;

                request()->logo_web_light->storeAs('assets', $filename, $this->settingService->diskName());

                $this->settingService->modify('logo_web_light', $filename);
            }

            if (request()->hasFile('logo_web_dark')) {
                $getFileName = pathinfo(request()->logo_web_dark->getClientOriginalName(), PATHINFO_FILENAME);
                $getFileExtension = request()->logo_web_dark->getClientOriginalExtension();

                $filename = $getFileName . '-' . Str::random(10) . '.' . $getFileExtension;

                request()->logo_web_dark->storeAs('assets', $filename, $this->settingService->diskName());

                $this->settingService->modify('logo_web_dark', $filename);
            }

            if (request()->hasFile('ogi_homepage')) {
                $getFileName = pathinfo(request()->ogi_homepage->getClientOriginalName(), PATHINFO_FILENAME);
                $getFileExtension = request()->ogi_homepage->getClientOriginalExtension();

                $filename = $getFileName . '-' . Str::random(10) . '.' . $getFileExtension;

                request()->ogi_homepage->storeAs('assets', $filename, $this->settingService->diskName());

                $this->settingService->modify('ogi_homepage', $filename);
            }

            if (request()->hasFile('logo_dashboard')) {
                $getFileName = pathinfo(request()->logo_dashboard->getClientOriginalName(), PATHINFO_FILENAME);
                $getFileExtension = request()->logo_dashboard->getClientOriginalExtension();

                $filename = $getFileName . '-' . Str::random(10) . '.' . $getFileExtension;

                request()->logo_dashboard->storeAs('assets', $filename,$this->settingService->diskName());

                $this->settingService->modify('logo_dashboard', $filename);
            }

            if (request()->hasFile('logo_auth')) {
                $getFileName = pathinfo(request()->logo_auth->getClientOriginalName(), PATHINFO_FILENAME);
                $getFileExtension = request()->logo_auth->getClientOriginalExtension();

                $filename = $getFileName . '-' . Str::random(10) . '.' . $getFileExtension;

                request()->logo_auth->storeAs('assets', $filename,$this->settingService->diskName());

                $this->settingService->modify('logo_auth', $filename);
            }

            return Redirect::to(route('settings.index') . "#web-properties")->withSuccess(__('message.saved_successfully'));
        }

        if (request()->has('web_config')) {

            Cache::forget('settings');

            $arrayValues = [
                ['key' => 'measurement_id', 'value' => request('measurement_id')],
                ['key' => 'publisher_id', 'value' => request('publisher_id')],
                ['key' => 'property_id', 'value' => request('property_id')],
                ['key' => 'disqus_shortname', 'value' => request('disqus_shortname')],
            ];

            if (request()->hasFile('credentials_file')) {
                $filename = request()->credentials_file->getClientOriginalName();
                if (!File::exists(storage_path('app/analytics'))) {
                    File::makeDirectory(storage_path('app/analytics'));
                }
                request()->credentials_file->storeAs('', $filename, 'analytics');
                array_push($arrayValues, ['key' => 'credentials_file', 'value' => request('credentials_file')]);
            }

            if (!EnvEditor::keyExists("ANALYTICS_PROPERTY_ID")) {
                EnvEditor::addKey('ANALYTICS_PROPERTY_ID', request('property_id'));
            } else {
                EnvEditor::editKey('ANALYTICS_PROPERTY_ID', request('property_id'));
            }

            foreach ($arrayValues as $value) {
                $this->settingService->modify($value['key'], $value['value']);
            }

            return Redirect::to(route('settings.index') . "#web-config")->withSuccess(__('message.saved_successfully'));
        }

        if (request()->has('web_permalinks')) {

            Cache::forget('settings');

            if(request('permalink') == 'custom'){
                $permalink            = request('custom_input');
                $permalink_type       = request('permalink');
                $permalink_old_custom = request('custom_input');
            }else{
                $permalink            = request('permalink');
                $permalink_type       = request('permalink');
                $permalink_old_custom = config('settings.permalink_old_custom');
            }

            $page_permalinks = request('page_permalink_type');
            $category_permalinks = request('category_permalink_type');

            $arrayValues = [
                ['key' => 'permalink_type', 'value' => $permalink_type ],
                ['key' => 'permalink', 'value' => $permalink],
                ['key' => 'permalink_old_custom', 'value' => $permalink_old_custom],
                ['key' => 'page_permalink_type', 'value' => $page_permalinks],
                ['key' => 'category_permalink_type', 'value' => $category_permalinks],
            ];

            foreach ($arrayValues as $value) {
                $this->settingService->modify($value['key'], $value['value']);
            }

            return response()->json(['success' => __('message.saved_successfully')]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createDataLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required',
            'url'   => 'required|url:http,https',
            'icon'  => 'required',
            'color' => 'required',
        ]);

        $errors = [];

        if ($validator->fails()) {
            $errors = ['errors' => $validator->errors()];
        }

        if ($errors) {
            return response()->json($errors);
        } else {
            $dataArr = json_decode(config('settings.links'), true);

            $recentLinks = Arr::last($dataArr);

            $newItem = [
                'id'    => $recentLinks ? $recentLinks['id'] + 1 : 1,
                'name'  => $request->label,
                'url'   => $request->url,
                'icon'  => $request->icon,
                'color' => $request->color
            ];

            array_push($dataArr, $newItem);

            Cache::forget('settings');
            $this->settingService->modify('links', json_encode($dataArr));
        }

        return response()->json(['data' => $dataArr, 'success' => __('message.saved_successfully')]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function removeDataLink($id)
    {
        $dataArr = json_decode(config('settings.links'), true);

        foreach ($dataArr as $key => $value) {
            if ($value['id'] == $id) {
                Arr::forget($dataArr, $key);
            }
        }

        Cache::forget('settings');
        $this->settingService->modify('links', json_encode($dataArr));

        return response()->json(['success' => __('message.deleted_successfully')]);
    }


    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function openGraphImage()
    {
        $ogiCategory    = $this->settingService->getAssetImage(config('settings.ogi_category'));
        $ogiContact     = $this->settingService->getAssetImage(config('settings.ogi_contact'));
        $ogiPage        = $this->settingService->getAssetImage(config('settings.ogi_page'));
        $ogiPopularPost = $this->settingService->getAssetImage(config('settings.ogi_popular_post'));
        $ogiPosts       = $this->settingService->getAssetImage(config('settings.ogi_posts'));
        $ogiSearch      = $this->settingService->getAssetImage(config('settings.ogi_search'));
        $ogiArticlePost = $this->settingService->getAssetImage(config('settings.ogi_article_post'));
        $ogiVideoPost   = $this->settingService->getAssetImage(config('settings.ogi_video_post'));
        $ogiAudioPost   = $this->settingService->getAssetImage(config('settings.ogi_audio_post'));
        $ogiTag         = $this->settingService->getAssetImage(config('settings.ogi_tag'));

        return view('admin.settings.ogi-custom', compact(
            'ogiCategory', 'ogiContact', 'ogiPage', 'ogiPopularPost', 'ogiPosts', 'ogiSearch', 'ogiArticlePost', 'ogiVideoPost', 'ogiAudioPost', 'ogiTag'
        ));
    }

    /**
     * @return mixed
     */
    public function ogiCustomUpdate()
    {
        Cache::forget('settings');

        if (request()->hasFile('ogi_category')) {
            $file = request('ogi_category');
            $this->settingService->openGraphUpdate($file, 'category');
        }

        if (request()->hasFile('ogi_contact')) {
             $file = request('ogi_contact');
            $this->settingService->openGraphUpdate($file, 'contact');
        }

        if (request()->hasFile('ogi_page')) {
            $file = request('ogi_page');
            $this->settingService->openGraphUpdate($file, 'page');
        }

        if (request()->hasFile('ogi_popular_post')) {
            $file = request('ogi_popular_post');
            $this->settingService->openGraphUpdate($file, 'popular_post');
        }

        if (request()->hasFile('ogi_posts')) {
            $file = request('ogi_posts');
            $this->settingService->openGraphUpdate($file, 'posts');
        }

        if (request()->hasFile('ogi_search')) {
            $file = request('ogi_search');
            $this->settingService->openGraphUpdate($file, 'search');
        }

        if (request()->hasFile('ogi_article_post')) {
            $file = request('ogi_article_post');
            $this->settingService->openGraphUpdate($file, 'article_post');
        }

        if (request()->hasFile('ogi_video_post')) {
            $file = request('ogi_video_post');
            $this->settingService->openGraphUpdate($file, 'video_post');
        }

        if (request()->hasFile('ogi_audio_post')) {
            $file = request('ogi_audio_post');
            $this->settingService->openGraphUpdate($file, 'audio_post');
        }

        if (request()->hasFile('ogi_article_post')) {
            $file = request('ogi_article_post');
            $this->settingService->openGraphUpdate($file, 'article_post');
        }

        if (request()->hasFile('ogi_tag')) {
            $file = request('ogi_tag');
            $this->settingService->openGraphUpdate($file, 'tag');
        }

        return redirect()->route('ogi.index')
                ->withSuccess(__('message.saved_successfully'));
    }

    /**
     * @return JsonResponse
     */
    public function import()
    {
        $validator = Validator::make(request()->all(), [
            'import' => 'required|mimes:xlsx'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Excel::import(new MagzImport, request()->file('import'));

        return response()->json(['success' => __('message.import_successfully')]);
    }

    /**
     * @return BinaryFileResponse|Response
     */
    public function export()
    {
        $name = config('retenvi.app_name') . '-v' . config('retenvi.version');
        $extension = '.xlsx';
        $fileName = $name . '.' . $extension;
        return (new MagzExport())->download($fileName);
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportStorage()
    {
        $zip = new ZipArchive;

        $name      = config('retenvi.app_name') . '-v' . config('retenvi.version');
        $extension = 'storage.zip';
        $fileName  = $name . '-' . $extension;

        if ($zip->open(storage_path($fileName), ZipArchive::CREATE) === TRUE) {
            if ($this->settingService->diskStorage()->exists('analytics')) {
                $ads = File::files(storage_path('app/analytics'));
                foreach ($ads as $key => $value) {
                    $relativeNameInZipFile = 'analytics/' . basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            }

            if ($this->settingService->diskStorage()->exists('ad')) {
                $ads = File::files(storage_path('app/public/ad'));
                foreach ($ads as $key => $value) {
                    $relativeNameInZipFile = 'public/ad/' . basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            }

            if ($this->settingService->diskStorage()->exists('audios')) {
                $ads = File::files(storage_path('app/public/audios'));
                foreach ($ads as $key => $value) {
                    $relativeNameInZipFile = 'public/audios/' . basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            }

            if ($this->settingService->diskStorage()->exists('assets')) {
                $assets = File::files(storage_path('app/public/assets'));
                foreach ($assets as $key => $value) {
                    $relativeNameInZipFile = 'public/assets/' . basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            }

            if ($this->settingService->diskStorage()->exists('avatar')) {
                $avatars = File::files(storage_path('app/public/avatar'));
                foreach ($avatars as $key => $value) {
                    $relativeNameInZipFile = 'public/avatar/' . basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            }

            if ($this->settingService->diskStorage()->exists('file')) {
                $file_localize = File::files(storage_path('app/public/file'));
                foreach ($file_localize as $key => $value) {
                    $relativeNameInZipFile = 'public/file/' . basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            }

            if ($this->settingService->diskStorage()->exists('images')) {
                $images = File::files(storage_path('app/public/images'));
                foreach ($images as $key => $value) {
                    $relativeNameInZipFile = 'public/images/' . basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            }

            if ($this->settingService->diskStorage()->exists('videos')) {
                $images = File::files(storage_path('app/public/videos'));
                foreach ($images as $key => $value) {
                    $relativeNameInZipFile = 'public/videos/' . basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            }

            $zip->close();
        }

        return response()->download(storage_path($fileName))->deleteFileAfterSend(true);
    }

    /**
     * webInformation
     *
     * @return void
     */
    public function webInformation()
    {
        $dir = config('settings.current_theme_dir');
        $creditFooter = File::get(resource_path('views/frontend/' . $dir . '/inc/_credit-footer.blade.php'));

        return view('admin.settings.web-info', compact('creditFooter'));
    }


    /**
     * updateWebInformation
     *
     * @param Request $request
     * @return void
     */
    public function updateWebInformation(Request $request)
    {
        if (request('credit_footer')) {
            $dir = config('settings.current_theme_dir');
            File::put(resource_path('views/frontend/'.$dir.'/inc/_credit-footer.blade.php'), request('credit_footer'));
        }

        $arrayValues = [
            ['key' => 'company_name', 'value' => request('company_name')],
            ['key' => 'site_name', 'value' => request('site_name')],
            ['key' => 'site_url', 'value' => request('site_url')],
            ['key' => 'site_description', 'value' => request('site_description')],
            ['key' => 'meta_keyword', 'value' => request('meta_keyword')],
        ];

        Cache::forget('settings');

        foreach ($arrayValues as $value) {
            $this->settingService->modify($value['key'], $value['value']);
        }

        return redirect()->route('settings.webinfo')->withSuccess(__('message.saved_successfully'));
    }

    /**
     * webContact
     *
     * @return void
     */
    public function webContact()
    {
        $links = json_decode(config('settings.links'));

        return view('admin.settings.web-contact', compact('links'));
    }

    /**
     * updateWebContact
     *
     * @param Request $request
     * @return void
     */
    public function updateWebContact(Request $request)
    {
        $this->authorize('update-settings');

        $arrayValues = [
            ['key' => 'street', 'value' => $request->street],
            ['key' => 'city', 'value' => $request->city],
            ['key' => 'postal_code', 'value' => $request->postal_code],
            ['key' => 'state', 'value' => $request->state],
            ['key' => 'country', 'value' => $request->country],
            ['key' => 'site_phone', 'value' => $request->site_phone],
            ['key' => 'site_email', 'value' => $request->site_email],
            ['key' => 'contact_description', 'value' => $request->contact_description]
        ];

        Cache::forget('settings');

        foreach ($arrayValues as $value) {
            $this->settingService->modify($value['key'], $value['value']);
        }

        return redirect()->route('settings.webcontact')->withSuccess(__('message.saved_successfully'));
    }

    /**
     * webProperties
     *
     * @return void
     */
    public function webProperties()
    {
        $logoWebLight  = $this->settingService->getAssetImage(config('settings.logo_web_light'));
        $logoWebDark   = $this->settingService->getAssetImage(config('settings.logo_web_dark'));
        $favicon       = $this->settingService->getAssetImage(config('settings.favicon'));
        $ogiHomepage   = $this->settingService->getAssetImage(config('settings.ogi_homepage'));
        $logoDashboard = $this->settingService->getAssetImage(config('settings.logo_dashboard'));
        $logoAuth      = $this->settingService->getAssetImage(config('settings.logo_auth'));

        return view('admin.settings.web-properties', compact(
            'favicon',
            'logoAuth',
            'logoDashboard',
            'logoWebLight',
            'logoWebDark',
            'ogiHomepage',
        ));
    }

    /**
     * uploadProperties
     *
     * @param Request $request
     * @return void
     */
    public function uploadProperties(Request $request)
    {
        // validate data
        $validator = Validator::make($request->all(), [
            'asset' => [
                'required',
                'string',
                Rule::in([
                    'logo_web_light',
                    'logo_web_dark',
                    'favicon',
                    'logo_dashboard',
                    'logo_auth',
                    'ogi_homepage',
                    'ogi_article_post',
                    'ogi_page',
                    'ogi_video_post',
                    'ogi_audio_post',
                    'ogi_category',
                    'ogi_tag',
                    'ogi_posts',
                    'ogi_popular_post',
                    'ogi_contact',
                    'ogi_search',
                ]),
            ],
            'file' => ['required', 'file', 'mimes:png,jpg,jpeg,gif,webp', 'max:5000'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'asset' => $request->input('asset'),
                'errors' => $validator->errors(),
            ], 422);
        }

        $filename = $this->settingService->uploadFile('assets', $request->file('file'));
        $this->settingService->modify($request->input('asset'), $filename);
        Cache::forget('settings');

        return response()->json([
            'asset' => $request->input('asset'),
            'success' => __('message.image_uploaded_successfully'),
        ]);
    }

    /**
     * webConfig
     *
     * @return void
     */
    public function webConfig()
    {
        $emailVerification = config('settings.email_verification') === 'y' ? 'checked' : '';
        $maintenance = config('settings.maintenance') === 'y' ? 'checked' : '';
        $languages = Language::select('name', 'language', 'active')->where('active', 'y')->pluck('name', 'language');
        $showLanguage = config('settings.display_language') === 'y' ? 'checked' : '';
        $propertyId = EnvEditor::getKey("ANALYTICS_PROPERTY_ID");
        $register = config('settings.register') === 'y' ? 'checked' : '';
        $commentApproval       = config('settings.comment_approval')         === 'y' ? 'checked' : '';
        $sendCommentReplyEmail = config('settings.send_comment_reply_email') === 'y' ? 'checked' : '';
        $numberNestedComments = [2,3,4,5,6,7,8,9,10];

        return view('admin.settings.web-config', compact('propertyId',
            'emailVerification',
            'showLanguage',
            'languages',
            'maintenance',
            'register',
            'commentApproval',
            'sendCommentReplyEmail',
            'numberNestedComments'
        ));
    }


    /**
     * updateWebConfig
     *
     * @param Request $request
     * @return void
     */
    public function updateWebConfig(Request $request)
    {
        Cache::forget('settings');

        $arrayValues = [
            ['key' => 'measurement_id', 'value' => request('measurement_id')],
            ['key' => 'publisher_id', 'value' => request('publisher_id')],
            ['key' => 'disqus_shortname', 'value' => request('disqus_shortname')],
            ['key' => 'property_id', 'value' => request('property_id')],
        ];

        if (request()->hasFile('credentials_file')) {
            $filename = request()->credentials_file->getClientOriginalName();
            if (!File::exists(storage_path('app/analytics'))) {
                File::makeDirectory(storage_path('app/analytics'));
            }
            request()->credentials_file->storeAs('', $filename, 'analytics');
            array_push($arrayValues, ['key' => 'credentials_file', 'value' => request('credentials_file')]);
        }

        if (!EnvEditor::keyExists("ANALYTICS_PROPERTY_ID")) {
            EnvEditor::addKey('ANALYTICS_PROPERTY_ID', request('property_id'));
        } else {
            EnvEditor::editKey('ANALYTICS_PROPERTY_ID', request('property_id'));
        }

        foreach ($arrayValues as $value) {
            $this->settingService->modify($value['key'], $value['value']);
        }

        return redirect()->route('settings.webconfig')->withSuccess(__('message.saved_successfully'));
    }

    /**
     * webBackup
     *
     * @return void
     */
    public function webBackup()
    {
        return view('admin.settings.web-backup');
    }

    /**
     * webPermalinks
     *
     * @return void
     */
    public function webPermalinks()
    {
        return view('admin.settings.web-permalinks');
    }

        /**
     * updateWebPermalinks
     *
     * @param Request $request
     * @return void
     */
    public function updateWebPermalinks(Request $request)
    {
        Cache::forget('settings');

        if(request('permalink') == 'custom'){
            $permalink            = request('custom_input');
            $permalink_type       = request('permalink');
            $permalink_old_custom = request('custom_input');
        }else{
            $permalink            = request('permalink');
            $permalink_type       = request('permalink');
            $permalink_old_custom = config('settings.permalink_old_custom');
        }

        $page_permalinks = request('page_permalink_type');
        $category_permalinks = request('category_permalink_type');

        $arrayValues = [
            ['key' => 'permalink_type', 'value' => $permalink_type ],
            ['key' => 'permalink', 'value' => $permalink],
            ['key' => 'permalink_old_custom', 'value' => $permalink_old_custom],
            ['key' => 'page_permalink_type', 'value' => $page_permalinks],
            ['key' => 'category_permalink_type', 'value' => $category_permalinks],
        ];

        foreach ($arrayValues as $value) {
            $this->settingService->modify($value['key'], $value['value']);
        }

        return redirect()->route('settings.webpermalinks')->withSuccess(__('message.saved_successfully'));
    }
}
