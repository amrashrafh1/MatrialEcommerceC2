<div class="col-md-12">
    {!! Form::open(['url' => route('products.update', $this->rows->id),'method'=> 'put','id'=>'edit-product',
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
                                aria-controls="Inventory" aria-selected="false"><i class="material-icons">
                                    store
                                </i>@lang('admin.inventory')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab"
                                aria-controls="shipping" aria-selected="false"><i class="material-icons">
                                    local_shipping
                                </i>@lang('admin.shipping')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" v-show="variant == 'simple'" id="attributes-tab" data-toggle="tab"
                                href="#attributes" role="tab" aria-controls="attributes" aria-selected="false"><i
                                    class="material-icons">
                                    edit_attributes
                                </i>@lang('admin.attributes')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" v-show="variant == 'variable'" id="variable-tab" data-toggle="tab"
                                href="#variable" role="tab" aria-controls="variable" aria-selected="false">
                                <i class="material-icons">
                                    category
                                </i>@lang('admin.variable')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Dimensions-tab" data-toggle="tab" href="#Dimensions" role="tab"
                                aria-controls="Dimensions" aria-selected="false"><i class="material-icons">
                                    height
                                </i>@lang('admin.Dimensions')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Data-tab" data-toggle="tab" href="#Data" role="tab"
                                aria-controls="Data" aria-selected="false"><i class="material-icons">
                                    height
                                </i>@lang('admin.Data')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                                aria-controls="settings" aria-selected="false">
                                <i class="material-icons">build</i>
                                @lang('admin.settings')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab"
                                aria-controls="seo" aria-selected="false">
                                <i class="material-icons">
                                    search
                                </i>
                                @lang('admin.seo')</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="col-md-12 p-3">
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="product_type" class=" control-label">Product type</label>
                    </div>
                    <div class="col-md-9">
                        <select name="product_type" v-model="variant" @change="variations" class="form-control">
                            <option disabled value="">product_type</option>
                            <option value="simple">Simple</option>
                            <option value="variable">Variable</option>
                        </select> </div>
                </div>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="name" class=" control-label">Name in {{$properties['name']}}</label>
                    </div>
                    <div class="col-md-9">

                        <input type="text" @if($localeCode === 'en') @keyup="changeSlug" @endif
                            name="name_{{$localeCode}}" class="form-control"
                            placeholder="Name in {{$properties['name']}}"
                            value="{{$this->rows->getTranslation('name', $localeCode)}}"
                            {{($localeCode === 'en') ? 'required':''}}>
                    </div>
                </div>
                @endforeach
                <br />
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="name" class="control-label">Slug</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="slug" class="form-control" placeholder="Slug" v-model="slug">
                    </div>
                </div>
                <br />
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="sku" class=" control-label">Sku</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="sku" class="form-control" value="{{$this->rows->sku}}"
                            placeholder="Sku">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="owner" class=" control-label">@lang('admin.Product_Owner')</label>
                    </div>
                    <div class="col-md-9">
                        <select name="owner" class="form-control" v-model="owner" required>
                            <option value="for_seller">@lang('admin.for_seller')</option>
                            <option value="for_site_owner">@lang('admin.owner')</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row" v-show="owner == 'for_seller'">
                    <div class="col-md-3">
                        <label for="seller_id" class="control-label">@lang('admin.Seller')</label>
                    </div>
                    <div class="col-md-9">
                        {!! Form::select('seller_id', \App\SellerInfo::where('approved',1)->pluck('name','id')
                        ,$this->rows->seller_id,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="Section" class=" control-label">Product Section in Homepage</label>
                    </div>
                    <div class="col-md-9">
                        <select name="section" class="form-control" v-model='section' required>
                            <option value="none">None</option>
                            <option value="hot_new_arrivals">Hot New arrivals section</option>
                            <option value="trending_now">Trending Now</option>
                            <option value="make_dreams_your_reality">Make dreams your reality</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="has_accessories" class=" control-label">@lang('admin.has_accessories')</label>
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
                                    <h2 class="mb-0">Main image (single file)</h2>
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
                                    <h2 class="mb-0 d-inline">Gallery (multiple file)</h2>
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
                                        <i class="material-icons">close</i>
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
                    <label for="stock" class=" control-label">Stock quantity</label>
                </div>
                <div class="col-md-9">
                    <input name="stock" value="{{$this->rows->stock}}" type="number" class="form-control"
                        placeholder="Stock quantity">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="purchase_price" class=" control-label">Purchase price</label>
                </div>
                <div class="col-md-9">
                    <input name="purchase_price" type="number" class="form-control" step="0.00"
                        placeholder="Purchase price" value="{{$this->rows->purchase_price}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="sale_price" class=" control-label">Regular price</label>
                </div>
                <div class="col-md-9">
                    <input name="sale_price" type="number" class="form-control" step="0.00" placeholder="Regular price"
                        value="{{$this->rows->sale_price}}">
                </div>
            </div>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="short_description" class=" control-label">Short Description in
                        {{$properties['name']}}</label>
                </div>
                <div class="col-md-9">
                    <textarea name="short_description_{{$localeCode}}" class="form-control"
                        placeholder="short description in  {{$properties['name']}}"
                        id="short_description_{{$localeCode}}">{!! $this->rows->short_description !!}</textarea>
                </div>
            </div>
            @endforeach
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="description" class=" control-label">Description in
                        {{$properties['name']}}</label>
                </div>
                <div class="col-md-9">
                    <textarea name="description_{{$localeCode}}" class="form-control"
                        placeholder="description in  {{$properties['name']}}"
                        id="description_{{$localeCode}}">{!! $this->rows->description !!}</textarea>
                </div>
            </div>
            @endforeach
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="description" class=" control-label">Tags in
                        {{$properties['name']}}</label>
                </div>
                @php
                $tags = [];
                foreach($this->rows->tags()->select('name')->get() as $tag) {
                $value = $tag->translate('name', $localeCode);
                array_push($tags, $value);
                }
                @endphp
                <div class="col-md-9">
                    <input type="text" name="tags_{{$localeCode}}" placeholder="Tags in {{$properties['name']}}"
                        value='{{(!empty($this->rows->tags))?implode(',', $tags):''}}' data-role="tagsinput">
                </div>
            </div>
            @endforeach
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="category_id" class=" control-label">Category</label>
                </div>
                <div class="col-md-9">
                    {!! Form::select('category_id', \App\Category::pluck('name','id')
                    ,$this->rows->category_id,['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="tradmark_id" class=" control-label">Brands</label>
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
                    <label for="tax" class=" control-label">Tax</label>
                </div>
                <div class="col-md-9">
                    <input name="tax" value="{{$this->rows->tax}}" type="number" class="form-control" step="0.00"
                        placeholder="tax">
                </div>
            </div>
            {{-- {{dd(\App\Shipping_methods::whereDoesntHave('products', function ($q){
                $q->where('id', '!=',1673);
                })->get())}} --}}
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="shippings" class=" control-label">shipping</label>
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
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="size_{{$localeCode}}" class=" control-label">size in {{$properties['name']}}</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="size_{{$localeCode}}" class="form-control"
                        placeholder="size in {{$properties['name']}}" value="{{$this->rows->size}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="color_{{$localeCode}}" class=" control-label">color</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="color_{{$localeCode}}" class="form-control"
                        placeholder="color in {{$properties['name']}}" value="{{$this->rows->color}}">
                </div>
            </div>
            @endforeach
        </div>
        <div class="tab-pane fade" id="variable" v-show="variant == 'variable'" role="tabpanel"
            aria-labelledby="variable-tab">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="attributes" class="control-label">Attributes</label>
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
                    <h3 class="h3">Dimensions</h3>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="attributes" class="control-label">length</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="length" class="form-control mb-4" placeholder="length"
                            value="{{$this->rows->length}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="attributes" class="control-label">width</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="width" class="form-control mb-4" placeholder="width"
                            value="{{$this->rows->width}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="attributes" class="control-label">height</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="height" class="form-control mb-4" placeholder="height"
                            value="{{$this->rows->height}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="attributes" class="control-label">weight</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" name="weight" class="form-control mb-4" placeholder="weight"
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
                    <label for="in_stock" class=" control-label">Status</label>
                </div>
                <div class="col-md-9">
                    <select name="in_stock" class="form-control" v-model="in_stock">
                        <option disabled value="" selected>Status</option>
                        <option value="in_stock"> In Stock</option>
                        <option value="out_stock"> Out Stock</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="stock" class=" control-label">Visible</label>
                </div>
                <div class="col-md-9">
                    <select name="visible" class="form-control" v-model="visible">
                        <option disabled value="" selected>visible</option>
                        <option value="visible">Visible</option>
                        <option value="hidden">Hidden</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <div class="form-group row {{($localeCode === 'en') ? 'required':''}}">
                <div class="col-md-3">
                    <label for="meta_tag_{{$localeCode}}" class=" control-label">@lang('user.meta_tag_'.$properties['name'])
                        </label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="meta_tag_{{$localeCode}}" class="form-control mb-4"
                        placeholder="@lang('user.meta_tag_'.$properties['name'])"
                        value="{{(!empty($this->rows->meta_tag))?$this->rows->getTranslation('meta_tag', $localeCode):''}}">
                </div>
            </div>
            <div class="form-group row {{($localeCode === 'en') ? 'required':''}}">
                <div class="col-md-3">
                    <label for="meta_description_{{$localeCode}}" class=" control-label">@lang('user.meta_description_'.$properties['name'])</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="meta_description" class="form-control mb-4"
                        placeholder="@lang('user.meta_description_'.$properties['name'])"
                        value="{{(!empty($this->rows->meta_description))?$this->rows->getTranslation('meta_description', $localeCode):''}}">
                </div>
            </div>
            <div class="form-group row {{($localeCode === 'en') ? 'required':''}}">
                <div class="col-md-3">
                    <label for="meta_keyword_{{$localeCode}}" class=" control-label">@lang('user.meta_keywords_'.$properties['name'])
                        </label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="meta_keyword_{{$localeCode}}"
                        value="{{(!empty($this->rows->meta_keyword))?$this->rows->getTranslation('meta_keyword', $localeCode):''}}"
                        data-role="tagsinput">
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="form-actions">
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
            variant: '{{$this->rows->product_type}}',
            variables: 'custom',
            chractersVariable: [],
            Variables: [],
            attributesFamily: '',
            selectedTags: [],
            selectedValue: [],
            slug: '{{$this->rows->slug}}',
            owner: '{{$this->rows->owner}}',
            section: '{{$this->rows->section}}',
            visible: '{{$this->rows->visible}}',
            in_stock: '{{$this->rows->in_stock}}',
            has_accessories: '{{$this->rows->has_accessories}}',
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
