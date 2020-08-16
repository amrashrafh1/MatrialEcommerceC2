<div class="col-md-12">
    <form action="{{route('products.store')}}" id="create-product" enctype="multipart/form-data"
        class="form-horizontal form-row-seperated" method="POST">
        @csrf
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
                            <label for="name" class=" control-label">Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="name_{{$localeCode}}" @if($localeCode === 'en') @keyup="changeSlug" @endif  class="form-control"
                                placeholder="Name in {{$properties['name']}}" value="{{old('name_'. $localeCode)}}">
                        </div>
                    </div>
                    @endforeach
                    <br />
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="name" class=" control-label">Slug</label>
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
                            <input type="text" name="sku" class="form-control" value="{{old('sku')}}" placeholder="Sku">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="owner" class=" control-label">Product Owner</label>
                        </div>
                        <div class="col-md-9">
                            <select name="owner" class="form-control" v-model="owner" required>
                                <option value="for_seller">For Seller</option>
                                <option value="for_site_owner">Owner</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" v-show="owner == 'for_seller'">
                        <div class="col-md-3">
                            <label for="user_id" class="control-label">Seller</label>
                        </div>
                        <div class="col-md-9">
                            {!! Form::select('user_id', \App\User::whereRoleIs('seller')->pluck('email','id')
                            ,old('user_id'),['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="Section" class=" control-label">Product Section in Homepage</label>
                        </div>
                        <div class="col-md-9">
                            <select name="section" class="form-control" value="{{old('section')}}" required>
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
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div>
                            <div class="card shadow">
                                <div class="card-header">
                                    <h2 class="mb-0">Main image (single file)</h2>
                                </div>
                                <div class="card-body">
                                    <input name="image" type="file" class="dropify-single" data-height="300" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <div class="card shadow">
                                <div class="card-header">
                                    <h2 class="mb-0">Gallery (multiple file)</h2>
                                </div>
                                <div class="card-body">
                                    <input name="gallery[]" type="file" class="dropify-multi" data-height="300"
                                        multiple />
                                </div>
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
                        <input name="stock" value="{{old('stock')}}" type="number" class="form-control"
                            placeholder="Stock quantity">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="purchase_price" class=" control-label">Purchase price</label>
                    </div>
                    <div class="col-md-9">
                        <input name="purchase_price" type="number" class="form-control" step="0.00"
                            placeholder="Purchase price" value="{{old('purchase_price')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="sale_price" class=" control-label">Regular price</label>
                    </div>
                    <div class="col-md-9">
                        <input name="sale_price" type="number" class="form-control" step="0.00"
                            placeholder="Regular price" value="{{old('sale_price')}}">
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
                            id="short_description_{{$localeCode}}">{!! old('short_description_'.$localeCode) !!}</textarea>
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
                            id="description_{{$localeCode}}">{!! old('description_'.$localeCode) !!}</textarea>
                    </div>
                </div>
                @endforeach
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="tags" class=" control-label">Tags in
                            {{$properties['name']}}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="tags_{{$localeCode}}"
                            placeholder="Tags in {{$properties['name']}}" data-role="tagsinput">
                    </div>
                </div>
                @endforeach
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="category_id" class=" control-label">Category</label>
                    </div>
                    <div class="col-md-9">
                        {!! Form::select('category_id', \App\Category::pluck('name','id')
                        ,old('category_id'),['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="tradmark_id" class=" control-label">Brands</label>
                    </div>
                    <div class="col-md-9">
                        {!! Form::select('tradmark_id', \App\Tradmark::pluck('name','id')
                        ,old('tradmark_id'),['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="tax" class=" control-label">Tax</label>
                    </div>
                    <div class="col-md-9">
                        <input name="tax" value="{{old('tax')}}" type="number" class="form-control" step="0.00"
                            placeholder="tax">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="shipping_id" class=" control-label">shipping</label>
                    </div>
                    <div class="col-md-9">
                        <select class="js-example-basic-multiple" style="width:100%;" name="shippings[]"
                            multiple="multiple" value="{{old('shippings[]')}}">
                            @foreach($data as $attribute)
                            <option value="{{$attribute->id}}">
                                {{$attribute->zone->name.' / '.$attribute->shippingcompany->name.' / '.$attribute->name}}
                            </option>
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
                            placeholder="size in {{$properties['name']}}" value="{{old('size_'.$localeCode)}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="color_{{$localeCode}}" class=" control-label">color</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="color_{{$localeCode}}" class="form-control"
                            placeholder="color in {{$properties['name']}}" value="{{old('color_'.$localeCode)}}">
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
                            multiple="multiple" value="{{old('attributes[]')}}">
                            @foreach(\App\Attribute::get() as $attribute)
                            <option value="{{$attribute->id}}">{{$attribute->name}}</option>
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
                                value="{{old('length')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="attributes" class="control-label">width</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="width" class="form-control mb-4" placeholder="width"
                                value="{{old('width')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="attributes" class="control-label">height</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="height" class="form-control mb-4" placeholder="height"
                                value="{{old('height')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="attributes" class="control-label">weight</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="weight" class="form-control mb-4" placeholder="weight"
                                value="{{old('weight')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="in_stock" class=" control-label">Status</label>
                    </div>
                    <div class="col-md-9">
                        <select name="in_stock" class="form-control" value="{{old('in_stock')}}">
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
                        <select name="visible" class="form-control" value="{{old('visible')}}">
                            <option disabled value="" selected>visible</option>
                            <option value="visible">Visible</option>
                            <option value="hidden">Hidden</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="meta_title_{{$localeCode}}" class=" control-label">@lang('admin.meta_title')
                            {{$properties['name']}}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="meta_title_{{$localeCode}}" class="form-control mb-4"
                            placeholder="@lang('admin.meta_title')" value="{{old('meta_title_'.$localeCode)}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="meta_description_{{$localeCode}}"
                            class=" control-label">@lang('admin.meta_description')
                            {{$properties['name']}}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="meta_description" class="form-control mb-4"
                            placeholder="@lang('admin.meta_description')"
                            value="{{old('meta_description_'.$localeCode)}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="keywords_{{$localeCode}}" class=" control-label">@lang('admin.meta_keywords')
                            {{$properties['name']}}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="keywords" value="" data-role="tagsinput">
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
                            <input type="submit" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</form>
</div>
@push('js')
<link href="{{url('/')}}/css/dropify.css" rel="stylesheet" type="text/css" />

<script src="{{url('/')}}/js/dropify.min.js"></script>

<script>
    var vuejs = new Vue({
        el: '#create-product',
        data: {
            variant: 'simple',
            variables: 'custom',
            chractersVariable: [],
            Variables: [],
            attributesFamily: '',
            selectedTags: [],
            selectedValue: [],
            slug: '',
            owner: 'for_site_owner',
            has_accessories: 'yes',
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

</script>

@livewireAssets

@endpush
