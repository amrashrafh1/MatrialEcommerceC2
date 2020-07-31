<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data_en = explode(',',$request['attributes_en']);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            ($localeCode == 'en')?'':${'data_' . $localeCode} = explode(',',$request['attributes_'.$localeCode]);
        }
        foreach($data_en as $index => $att) {
            $create = Attribute::create([
                'name'      => $att,
                'family_id' => $id
            ]);
            foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                if($localeCode == 'en') {
                    $create->setTranslation('name', $localeCode, $att)->save();
                }else {
                    if (!empty(${'data_' . $localeCode}[$index])) {
                        $create->setTranslation('name', $localeCode, ${'data_' . $localeCode}[$index])->save();
                    }
                }
            }
        }
        return redirect()->route('attribute_families.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attrs = Attribute::where('family_id', $id)->get();
        foreach($attrs as $attr) {
            $attr->delete();
        }
        $data_en = explode(',',$request['attributes_en']);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            ($localeCode == 'en')?'':${'data_' . $localeCode} = explode(',',$request['attributes_'.$localeCode]);
        }
        foreach($data_en as $index => $att) {
            $create = Attribute::create([
                'name'      => $att,
                'family_id' => $id
            ]);
            foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                if($localeCode == 'en') {
                    $create->setTranslation('name', $localeCode, $att)->save();
                }else {
                    if (!empty(${'data_' . $localeCode}[$index])) {
                        $create->setTranslation('name', $localeCode, ${'data_' . $localeCode}[$index])->save();
                    }
                }
            }
        }
        return redirect()->route('attribute_families.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
