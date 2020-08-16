<?php

namespace App\Http\Controllers\FrontEnd;

use App\ContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Alert;
class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = \App\Setting::orderBy('id','desc')->first();

        return view('FrontEnd.contact_us', ['setting' => $setting]);
    }

    protected function formResponse()
    {
        return redirect()->back()
            ->withSuccess(trans('user.Your_form_has_been_submitted'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->faxonly) {
            return $this->formResponse();
        }

        $data = $this->validate(request(),[
            'name'    => 'required|string|max:199',
            'email'   => 'required|email',
            'mobile'  => 'required|string|max:199',
            'subject' => 'required|string|max:199',
            'message' => 'required|string|max:1000',
        ],[],[
            'name'    => trans('user.name'),
            'email'   => trans('user.email'),
            'mobile'  => trans('user.mobile'),
            'subject' => trans('user.subject'),
            'message' => trans('user.message'),
        ]);

        ContactUs::create($data);

        return redirect()->route('contact_us')->withSuccess(trans('user.Your_form_has_been_submitted'));;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contactUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactUs)
    {
        //
    }
}
