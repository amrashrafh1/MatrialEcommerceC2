<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\SellerCountries;
class SettingController extends Controller
{
    protected $model = '';
    protected $path  = 'settings';
    protected $route = 'settings';

    public function __construct()
    {
        $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->model = Setting::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Setting::with('seller_countries')->orderBy('id', 'desc')->first();
        return view('Admin.'. $this->path.'.create',['title' => 'Setting', 'rows' => $rows]);
    }

    public function update(Request $request)
    {
        $data = $this->validate(request(), [
            'sitename_en'       => 'required|string|max:255',
            'country_id.*'      => 'required|numeric|exists:countries,id',
            'logo'              => 'required_if:id,null|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'icon'              => 'required_if:id,null|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'email'             => 'sometimes|nullable|string|max:255',
            'mobile'            => 'required|string',
            'system_status'     => 'required|string|max:255',
            'system_message_en' => 'sometimes|nullable|string',
            'location'          => 'required|string',
            'paypal'            => 'required|in:1,0',
            'stripe'            => 'required|in:1,0',
            'fees'              => 'required|numeric',
            'default_shipping'  => 'required|numeric',
            'facebook'          => 'sometimes|nullable|url',
            'twitter'           => 'sometimes|nullable|url',
            'twitter_login'     => 'sometimes|nullable|in:1,0',
            'facebook_login'    => 'sometimes|nullable|in:1,0',
            'google_login'      => 'sometimes|nullable|in:1,0',
            'github'            => 'sometimes|nullable|in:1,0',
            'default_shipping'  => 'required|numeric',
            'shipping_method'   => 'required|numeric',
            'meta_tag_en'          => 'sometimes|nullable|string',
            'meta_description_en'  => 'sometimes|nullable|string',
            'meta_keyword_en'      => 'sometimes|nullable|string',
        ],[],[
            'sitename_en'         => trans('admin.sitename'),
            'country_id'          => trans('admin.country_id'),
            'logo'                => trans('admin.logo'),
            'email'               => trans('admin.email'),
            'icon'                => trans('admin.icon'),
            'system_status'       => trans('admin.system_status'),
            'system_message_en'   => trans('admin.system_message'),
            'location'            => trans('admin.location'),
            'mobile'              => trans('admin.mobile'),
            'shipping_method'     => trans('admin.shipping_method'),
            'default_shipping'    => trans('admin.default_shipping'),
            'fees'                => trans('admin.fees'),
            'paypal'              => trans('admin.paypal'),
            'stripe'              => trans('admin.stripe'),
            'facebook'            => trans('admin.facebook'),
            'twitter'             => trans('admin.twitter'),
            'google_login'        => trans('admin.google_login'),
            'facebook_login'      => trans('admin.facebook_login'),
            'github'              => trans('admin.github'),
            'twitter_login'       => trans('admin.twitter_login'),
            'meta_tag_en'         => trans('admin.meta_tag_English'),
            'meta_description_en' => trans('admin.meta_description_English'),
            'meta_keyword_en'     => trans('admin.meta_keyword_English'),
        ]);
        if(!empty($data['icon'])) {
            $data['icon'] = upload($data['icon'], 'settings', 32,32);
        }
            if(!empty($data['logo'])) {
            $data['logo'] = upload($data['logo'], 'settings', 200, 70);
        }
        $item = $this->model::latest('id')->first();
        if($item) {
            $da = $this->model::latest('id')->first();
            $da->update([
                //'sitename'         => $data['sitename_en'],
                'mobile'           => $data['mobile'],
                'location'         => $data['location'],
                'email'            => $data['email'],
                'logo'             => (!empty($data['logo']))?$data['logo']:$da->logo,
                'icon'             => (!empty($data['icon']))?$data['icon']:$da->icon,
                'system_status'    => $data['system_status'],
               // 'system_message'   => ($data['system_message_en'])?$data['system_message_en']:$da->system_message,
                'fees'             => $data['fees'],
                'paypal'           => $data['paypal'],
                'stripe'           => $data['stripe'],
                'facebook'         => $data['facebook'],
                'twitter'          => $data['twitter'],
                'twitter_login'    => $data['twitter_login'],
                'facebook_login'   => $data['facebook_login'],
                'google_login'     => $data['google_login'],
                'github'           => $data['github'],
                'default_shipping' => $data['default_shipping'],
                'shipping_method'  => $data['shipping_method'],
            ]);
            foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                (empty($request['sitename_' . $localeCode])) ?: $da->setTranslation('sitename', $localeCode, $request['sitename_' . $localeCode])->save();
                (empty($request['system_message_' . $localeCode])) ?: $da->setTranslation('system_message', $localeCode, $request['system_message_' . $localeCode])->save();
                (empty($request['meta_tag_' . $localeCode])) ?: $da->setTranslation('meta_tag', $localeCode, $request['meta_tag_' . $localeCode])->save();
                (empty($request['meta_description_' . $localeCode])) ?: $da->setTranslation('meta_description', $localeCode, $request['meta_description_' . $localeCode])->save();
                (empty($request['meta_keyword_' . $localeCode])) ?: $da->setTranslation('meta_keyword', $localeCode, $request['meta_keyword_' . $localeCode])->save();

            };
            (count($da->seller_countries) > 0)?SellerCountries::whereIn('id', $da->seller_countries->pluck('id'))->delete():'';
            foreach($data['country_id'] as $country) {
                SellerCountries::create([
                    'setting_id' => $da->id,
                    'country_id' => $country
                ]);
            }
        } else {
            $setting = $this->model::create([
                'sitename'         => $data['sitename_en'],
                'mobile'           => $data['mobile'],
                'location'         => $data['location'],
                'email'            => $data['email'],
                'logo'             => $data['logo'],
                'icon'             => $data['icon'],
                'system_status'    => $data['system_status'],
                'system_message'   => (!empty($data['system_message_en']))?$data['system_message_en']:NULL,
                'fees'             => $data['fees'],
                'paypal'           => $data['paypal'],
                'stripe'           => $data['stripe'],
                'facebook'         => $data['facebook'],
                'twitter'          => $data['twitter'],
                'twitter_login'    => $data['twitter_login'],
                'facebook_login'   => $data['facebook_login'],
                'google_login'     => $data['google_login'],
                'github'           => $data['github'],
                'default_shipping' => $data['default_shipping'],
                'shipping_method'  => $data['shipping_method'],
                'meta_tag'         => (empty($request['meta_tag_en'])) ? null : $request['meta_tag_en'],
                'meta_description' => (empty($request['meta_description_en'])) ? null : $request['meta_description_en'],
                'meta_keyword'     => (empty($request['meta_keyword_en'])) ? null : $request['meta_keyword_en'],

            ]);
            foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $setting->setTranslation('sitename', $localeCode, $request['sitename_'.$localeCode])->save();
                (empty($request['meta_tag_' . $localeCode])) ?: $setting->setTranslation('meta_tag', $localeCode, $request['meta_tag_' . $localeCode])->save();
                (empty($request['meta_description_' . $localeCode])) ?: $setting->setTranslation('meta_description', $localeCode, $request['meta_description_' . $localeCode])->save();
                (empty($request['meta_keyword_' . $localeCode])) ?: $setting->setTranslation('meta_keyword', $localeCode, $request['meta_keyword_' . $localeCode])->save();
                (empty($request['system_message_' . $localeCode])) ?: $setting->setTranslation('system_message', $localeCode, $request['system_message_' . $localeCode])->save();
            };
            foreach($data['country_id'] as $country) {
                SellerCountries::create([
                    'setting_id' => $setting->id,
                    'country_id' => $country
                ]);
            }
        }
        Alert::success(trans('admin.updated'), trans('admin.success_record'));
        $rows = Setting::latest('id')->first();

        if($data['system_status'] == 'open') {
            \Artisan::call('up');
        } elseif($data['system_status'] == 'close') {
            \Artisan::call('down');
        }
        return view('Admin.'. $this->path.'.create',['title' => 'Setting', 'rows' => $rows]);
    }
}
