<div class="col-md-12">
    {!! Form::open(['url' => route('seller_frontend_products_update', $this->rows->slug),'method'=> 'put','id'=>'edit-product',
    'enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-row-seperated']) !!}
    <div class="card card-nav-tabs card-plain">
        <div class="card-header card-header-primary">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                                aria-controls="general" aria-selected="true">@lang('admin.general')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Inventory-tab" data-toggle="tab" href="#Inventory" role="tab"
                                aria-controls="Inventory" aria-selected="false">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                @lang('admin.inventory')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab"
                                aria-controls="shipping" aria-selected="false">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                @lang('admin.shipping')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" v-show="variant == 'simple'" id="attributes-tab" data-toggle="tab"
                                href="#attributes" role="tab" aria-controls="attributes" aria-selected="false">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                                @lang('admin.attributes')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" v-show="variant == 'variable'" id="variable-tab" data-toggle="tab"
                                href="#variable" role="tab" aria-controls="variable" aria-selected="false">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                                @lang('admin.variable')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Dimensions-tab" data-toggle="tab" href="#Dimensions" role="tab"
                                aria-controls="Dimensions" aria-selected="false">
                                <i class="fa fa-arrows-alt" aria-hidden="true"></i> @lang('admin.Dimensions')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Data-tab" data-toggle="tab" href="#Data" role="tab"
                                aria-controls="Data" aria-selected="false">
                                <i class="fa fa-text-height" aria-hidden="true"></i>
                                @lang('admin.Data')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                                aria-controls="settings" aria-selected="false">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                @lang('admin.settings')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab"
                                aria-controls="seo" aria-selected="false">
                                <i class="fa fa-search">
                                </i>
                                @lang('admin.seo')</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <div class="tab-content mt-4" id="myTabContent">
        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="col-md-12 p-3">
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="product_type" class=" control-label">@lang('user.product_type') <abbr title="required" class="required">*</abbr></label>
                    </div>
                    <div class="col-md-9">
                        <select name="product_type" v-model="variant" @change="variations" class="form-control">
                            <option disabled value="">@lang('user.product_type')</option>
                                <option value="simple">@lang('user.simple')</option>
                                <option value="variable">@lang('user.variable')</option>
                        </select> </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="sku" class=" control-label">@lang('user.SKU') <abbr title="required" class="required">*</abbr></label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="sku" class="form-control" value="{{$this->rows->sku}}"
                            placeholder="@lang('user.SKU')" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="has_accessories" class=" control-label">@lang('admin.has_accessories') <abbr title="required" class="required">*</abbr></label>
                    </div>
                    <div class="col-md-9">
                        <select name="has_accessories" class="form-control" v-model="has_accessories" required>
                            <option value="yes">@lang('admin.yes')</option>
                            <option value="no">@lang('admin.no')</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div>
                            <div class="card shadow">
                                <div class="card-header">
                                    <h2 class="mb-0">@lang('user.Main_image_(single file)') <abbr title="required" class="required">*</abbr></h2>
                                </div>
                                <div class="card-body">
                                    <input name="image" type="file" class="dropify-single"
                                        data-default-file="{{Storage::url($this->rows->image)}}" data-height="300" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <div class="card shadow">
                                <div class="card-header">
                                    <h2 class="mb-0 d-inline">@lang('user.Gallery_(multiple file)')</h2>
                                </div>
                                <div class="card-body">
                                    @if(!empty($this->rows->gallery()->first()->file))
                                    <input name="gallery[]" type="file"
                                        data-default-file="{{Storage::url($this->rows->gallery()->first()->file)}}"
                                        class="dropify-multi" data-height="300" multiple />
                                    @else
                                    <input name="gallery[]" type="file" data-default-file="empty" class="dropify-multi"
                                        data-height="300" multiple />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="overflow:scroll;">
                        <div class="row">
                            @foreach($this->rows->gallery as $gallery)
                            <div class="col-4" style="position:relative;">
                                <img style="width:100%;" src="{{Storage::url($gallery->file)}}" height="450px;">
                                <div style="position:absolute; top:0;right:0;">
                                    <button wire:click='removeImage({{$gallery->id}})' type="button" rel="tooltip"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                        @lang('user.delete')
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="Inventory" role="tabpanel" aria-labelledby="Inventory-tab">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="stock" class=" control-label">@lang('user.Stock_quantity') <abbr title="required" class="required">*</abbr></label>
                </div>
                <div class="col-md-9">
                    <input name="stock" value="{{$this->rows->stock}}" type="number" class="form-control"
                        placeholder="@lang('user.Stock_quantity')">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="purchase_price" class=" control-label">@lang('user.Purchase_price') <abbr title="required" class="required">*</abbr></label>
                </div>
                <div class="col-md-9">
                    <input name="purchase_price" type="number" class="form-control" step="0.00"
                        placeholder="@lang('user.Purchase_price')" value="{{$this->rows->purchase_price}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="sale_price" class=" control-label">@lang('user.Regular_price')  <abbr title="required" class="required">*</abbr></label>
                </div>
                <div class="col-md-9">
                    <input name="sale_price" type="number" class="form-control" step="0.00" placeholder="@lang('user.Regular_price')"
                        value="{{$this->rows->sale_price}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="category_id" class=" control-label">Category</label>
                </div>
                <div class="col-md-9">
                    <select id=category class="custom-select mt-15 @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="0">Select a parent category</option>
                        @foreach($categories as $key => $category)
                            @if ($rows->category_id == $key)
                                <option value="{{ $key }}" selected> {{ $category }} </option>
                            @else
                                <option value="{{ $key }}"> {{ $category }} </option>
                            @endif
                        @endforeach
                    </select>
                    @error('category_id') {{ $message }} @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="tradmark_id" class=" control-label">@lang('user.Brands') <abbr title="required" class="required">*</abbr></label>
                </div>
                <div class="col-md-9">
                    {!! Form::select('tradmark_id', \App\Tradmark::pluck('name','id')
                    ,$this->rows->tradmark_id,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="tax" class=" control-label">@lang('user.Tax')</label>
                </div>
                <div class="col-md-9">
                    <input name="tax" value="{{$this->rows->tax}}" type="number" class="form-control" step="0.00"
                        placeholder="@lang('user.Tax')">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="shippings" class=" control-label">@lang('user.shipping') <abbr title="required" class="required">*</abbr></label>
                </div>
                <div class="col-md-9">
                    <select class="js-example-basic-multiple" style="width:100%;" name="shippings[]"
                        multiple="multiple">
                        @php
                        $id = $this->rows->id;
                        $shippings = \App\Shipping_methods::whereDoesntHave('products', function ($q) use ($id){
                        $q->where('id', '!=',$id);
                        })->get();
                        $array = [];
                        @endphp
                        @foreach($this->rows->methods as $attr)
                        @php
                        array_push($array,$attr->id);
                        @endphp
                        <option value="{{$attr->id}}" selected>
                            {{$attr->zone->name.' / '.$attr->shippingcompany->name.' / '.$attr->name}}
                        </option>
                        @endforeach
                        @foreach($shippings as $attribute)
                        @if(!in_array($attribute->id, $array))
                        <option value="{{$attribute->id}}">
                            {{$attribute->zone->name.' / '.$attribute->shippingcompany->name.' / '.$attribute->name}}
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="attributes" v-show="variant == 'simple'" role="tabpanel"
            aria-labelledby="attributes-tab">
            <nav>
                <div class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a style='color:#000 !important;' class="nav-link @if($localeCode == 'en') active show @endif"
                        id="{{$localeCode}}-tab" data-toggle="tab" href="#{{$localeCode}}" role="tab"
                        aria-controls="{{$localeCode}}" aria-selected="true">{{$localeCode}}</a>
                    @endforeach
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="tab-pane fade @if($localeCode == 'en') show active @endif" id="{{$localeCode}}"
                    role="tabpanel" aria-labelledby="{{$localeCode}}-tab">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="size_{{$localeCode}}"
                                class=" control-label">@lang('user.size_in_'.$properties['name'])</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="size_{{$localeCode}}" class="form-control"
                                placeholder="@lang('user.size_in_'.$properties['name'])"
                                value="{{old('size_'.$localeCode, $this->rows->getTranslation('size', $localeCode))}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="color_{{$localeCode}}"
                                class=" control-label">@lang('user.color_in_'.$properties['name'])</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="color_{{$localeCode}}" class="form-control"
                                placeholder="@lang('user.color_in_'.$properties['name'])"
                                value="{{old('color_'.$localeCode, $this->rows->getTranslation('color', $localeCode))}}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="variable" v-show="variant == 'variable'" role="tabpanel"
            aria-labelledby="variable-tab">
            <div class="form-group row required">
                <div class="col-md-3">
                    <label for="attributes" class="control-label">@lang('user.attribute')</label>
                </div>
                <div class="col-md-9">
                    <select class="js-example-basic-multiple" style="width:100%;" name="attributes[]"
                        multiple="multiple">

                        @php
                        $attributes = \App\Attribute::get();
                        $arrays = [];
                        @endphp
                        @foreach($this->rows->attributes as $attrs)
                        @php
                        array_push($arrays,$attrs->id);
                        @endphp
                        <option value="{{$attrs->id}}" selected>
                            {{$attrs->name}}
                        </option>
                        @endforeach
                        @foreach($attributes as $attribute)
                        @if(!in_array($attribute->id, $arrays))
                        <option value="{{$attribute->id}}">
                            {{$attribute->name}}
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <br />
        </div>
        <div class="tab-pane fade" id="Dimensions" role="tabpanel" aria-labelledby="Dimensions-tab">
            <div>
                <div class="col-md-12">
                    <h3 class="h3">@lang('user.Dimensions')</h3>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="attributes" class="control-label">@lang('user.length') <abbr title="required" class="required">*</abbr></label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="length" class="form-control mb-4" placeholder="@lang('user.length')"
                            value="{{$this->rows->length}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="attributes" class="control-label">@lang('user.width') <abbr title="required" class="required">*</abbr></label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="width" class="form-control mb-4" placeholder="@lang('user.width')"
                            value="{{$this->rows->width}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="attributes" class="control-label">@lang('user.height') <abbr title="required" class="required">*</abbr></label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="height" class="form-control mb-4" placeholder="@lang('user.height')"
                            value="{{$this->rows->height}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="attributes" class="control-label">@lang('user.weight') <abbr title="required" class="required">*</abbr></label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="weight" class="form-control mb-4" placeholder="@lang('user.weight')"
                            value="{{$this->rows->weight}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="Data" role="tabpanel" aria-labelledby="Data-tab">
            <div>
                <div class="col-md-12">
                    <h3 class="h3">@lang('admin.Data')</h3>
                </div>
                <ol id="list">
                    @if($this->rows->data)
                    @foreach($this->rows->data as $index => $value)
                    <li class="list_var">
                        <div class="form-group">
                            <div class="col-md-12 row" id='list_0'>
                                <div class='col m-1'>
                                    <input type='text' value='{{old('key.'.$index,key($value))}}' name='key[]' placeholder='{{trans('admin.key')}}' class='form-control'>
                                </div>
                                <div class='col m-1'>
                                    <input type='text' value='{{old('value.'.$index,$value[key($value)])}}' name='value[]' placeholder='{{trans('admin.value')}}' class='form-control'>
                                </div>
                            </div>
                        </div>
                        <button class="list_del btn btn-danger"><i class='fa fa-trash'></i></button>
                    </li>
                    @endforeach
                    @endif
                </ol>
                <button type='button' class="list_add btn btn-primary"><i class='fa fa-plus'></i></button>
                <br />
            </div>
        </div>
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="in_stock" class=" control-label">@lang('user.status') <abbr title="required" class="required">*</abbr></label>
                </div>
                <div class="col-md-9">
                    <select name="in_stock" class="form-control">
                        <option disabled>@lang('user.status')</option>
                        <option value="in_stock" {{($this->rows->in_stock === 'in_stock')?'selected':''}}> @lang('user.in_stock')</option>
                        <option value="out_stock" {{($this->rows->out_stock === 'out_stock')?'selected':''}}> @lang('user.out_stock')</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="stock" class=" control-label">@lang('user.visible') <abbr title="required" class="required">*</abbr></label>
                </div>
                <div class="col-md-9">
                    <select name="visible" class="form-control">
                    <option disabled>@lang('user.visible')</option>
                        <option value="visible" {{($this->rows->visible === 'visible')?'selected':''}}>@lang('user.visible')</option>
                        <option value="hidden" {{($this->rows->visible === 'hidden')?'selected':''}}>@lang('user.hidden')</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a style='color:#000 !important;' class="nav-item nav-link @if($localeCode == 'en') active show @endif" id="nav-{{$localeCode}}-tab" data-toggle="tab" href="#nav-{{$localeCode}}" role="tab" aria-controls="nav-{{$localeCode}}" aria-selected="true">{{$localeCode}}
                    </a>
                    @endforeach
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="tab-pane fade @if($localeCode == 'en') show active @endif" id="nav-{{$localeCode}}" role="tabpanel" aria-labelledby="nav-{{$localeCode}}-tab">
                    <div class="form-group row {{($localeCode === 'en') ? 'required':''}}">
                        <div class="col-md-3">
                            <label for="name" class=" control-label">@lang('user.Name_in_'.$properties['name'])
                                @if($localeCode == 'en') <abbr title="required"
                                    class="required">*</abbr>@endif</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" @keyup="changeSlug" name="name_{{$localeCode}}" class="form-control"
                                placeholder="@lang('user.Name_in_'.$properties['name'])"
                                value="{{old('name_'. $localeCode, $this->rows->getTranslation('name', $localeCode))}}" {{($localeCode === 'en') ? 'required':''}}>
                        </div>
                    </div>
                    @if($localeCode === 'en')
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="name" class=" control-label">@lang('user.slug') <abbr title="required"
                                    class="required">*</abbr></label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="slug" class="form-control" placeholder="@lang('user.slug')"
                                v-model="slug" required>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="short_description"
                                class=" control-label">@lang('user.Short_Description_in_'.
                                $properties['name']) @if($localeCode == 'en') <abbr title="required"
                                    class="required">*</abbr>@endif</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="short_description_{{$localeCode}}" class="form-control" placeholder="@lang('user.Short_Description_in_'.
                                $properties['name'])"
                                id="short_description_{{$localeCode}}">{!! old('short_description_'.$localeCode, $this->rows->getTranslation('short_description', $localeCode)) !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="description" class=" control-label">@lang('user.Description_in_'.
                                $properties['name']) @if($localeCode == 'en') <abbr title="required"
                                    class="required">*</abbr>@endif</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="description_{{$localeCode}}" class="form-control" placeholder="@lang('user.Description_in_'.
                                $properties['name'])"
                                id="description_{{$localeCode}}">{!! old('description_'.$localeCode,$this->rows->getTranslation('description', $localeCode)) !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="description" class=" control-label">@lang('user.Tags_in_'.
                                $properties['name'])</label>
                        </div>
                        @php
                        $tags = [];
                        foreach($this->rows->tags()->select('name')->get() as $tag) {
                        $value = $tag->translate('name', $localeCode);
                        array_push($tags, $value);
                        }
                        @endphp
                        <div class="col-md-9">
                            <input type="text" name="tags_{{$localeCode}}" placeholder="@lang('user.Tags_in_'.
                            $properties['name'])"
                                value='{{(!empty($this->rows->tags))?implode(',', $tags):''}}' data-role="tagsinput">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="meta_tag_{{$localeCode}}"
                                class=" control-label">@lang('user.meta_tag_'.$properties['name'])
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="meta_tag_{{$localeCode}}" class="form-control mb-4"
                                placeholder="@lang('user.meta_tag_'.$properties['name'])"
                                value="{{old('meta_tag_'.$localeCode,$this->rows->getTranslation('meta_tag', $localeCode))}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="meta_description_{{$localeCode}}"
                                class=" control-label">@lang('user.meta_description_'.$properties['name'])
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="meta_description_{{$localeCode}}" class="form-control mb-4"
                                placeholder="@lang('user.meta_description_'.$properties['name'])"
                                value="{{old('meta_description_'.$localeCode,$this->rows->getTranslation('meta_description', $localeCode))}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="meta_keyword_{{$localeCode}}"
                                class=" control-label">@lang('user.meta_keywords_'.$properties['name'])
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="meta_keyword_{{$localeCode}}" value="{{old('meta_keyword_'.$localeCode,$this->rows->getTranslation('meta_keyword', $localeCode))}}" data-role="tagsinput">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="form-actions mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-success" value="@lang('admin.save')">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@push('js')
<link href="{{url('/')}}/css/dropify.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script src="{{url('/')}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{url('/')}}/js/dropify.min.js"></script>
<script>
    var edit = new Vue({
        el: '#edit-product',
        data: {
            variant: '{{old("product_type",$this->rows->product_type)}}',
            variables: 'custom',
            chractersVariable: [],
            Variables: [],
            attributesFamily: '',
            selectedTags: [],
            selectedValue: [],
            slug: '{{old("slug",$this->rows->slug)}}',
            visible: '{{old("visible",$this->rows->visible)}}',
            in_stock: '{{old("in_stock",$this->rows->in_stock)}}',
            has_accessories: '{{old("has_accessories",$this->rows->has_accessories)}}',
        },
        computed: {

        },
        methods: {
            variations({
                target
            }) {
                this.variant = target.value;
            },
            deleteVariableRow(e, index) {
                e.preventDefault();
                this.Variables.splice(index, 1)
                this.chractersVariable.splice(index, 1)
            },
            countVariableChracter({
                target
            }, index) {
                this.chractersVariable[index]['count'] = 191 - target.value.length;
            },
            SaveAttributes(e) {
                e.preventDefault();

            },
            addRow(e) {
                e.preventDefault();
                this.inputs.push({
                    one: ''
                });
            },
            deleteRow(e, index) {
                e.preventDefault();
                this.inputs.splice(index, 1)
            },
            filterTags({
                target
            }, index) {
                this.selectedTags.push({
                    [index]: target.value
                });
                console.log(this.selectedTags);
            },
            changeSlug({
                target
            }) {
                this.slug = target.value.split(' ').join('-')
            }
        }
    });

</script>
<script>
    $('.dropify-single').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong appended.'
        },
        error: {
            'fileSize': 'The file size is too big (2M max).'
        }
    });
    $('.dropify-multi').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong appended.'
        },
        error: {
            'fileSize': 'The file size is too big (2M max).'
        }
    });
    $(".mcs-horizontal-example").mCustomScrollbar({
        axis: "x",
        theme: "dark-3",
        advanced: {
            autoExpandHorizontalScroll: true
        }
    });
    document.addEventListener("livewire:load", function (event) {
        window.livewire.beforeDomUpdate(() => {
            // Add your custom JavaScript here.
        });

        window.livewire.afterDomUpdate(() => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{trans("admin.updated_record")}}',
                showConfirmButton: true,
                timer: 1500
            });
        });
    });

</script>
<script type="text/javascript" src="{{ asset('/js/add-input-area.min.js')}}"></script>
<script>
$(document).ready(function() {
	var max_fields      = 20; //maximum input boxes allowed
	var wrapper   		= $("#list"); //Fields wrapper
	var add_button      = $(".list_add"); //Add button ID

	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append("<li class='list_var'><div class='form-group'><div class='col-md-12 row' id='list_0'><div class='col m-1'><input type='text' value='' name='key[]' placeholder='{{trans('admin.key')}}' class='form-control'></div><div class='col m-1'><input type='text' value='' name='value[]' placeholder='{{trans('admin.value')}}' class='form-control'></div></div></div><button class='list_del btn btn-danger'><i class='fa fa-trash'></i></button></li>"); //add input box
		}
	});

	$(wrapper).on("click",".list_del", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('li').remove(); x--;
	})
});
</script>
@livewireAssets
@endpush
