<template>
    <div class="col-md-12">
        <form :action="route" id="create-product" enctype="multipart/form-data" class="form-horizontal form-row-seperated"
            method="POST">
            <input type="hidden" name="_token" :value="csrf">

            <div class="row">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general"
                            role="tab" aria-controls="v-pills-general" aria-selected="true">General</a>
                        <a class="nav-link" id="v-pills-inventory-tab" data-toggle="pill" href="#v-pills-inventory"
                            role="tab" aria-controls="v-pills-inventory" aria-selected="false">Inventory</a>
                        <a class="nav-link" id="v-pills-shipping-tab" data-toggle="pill" href="#v-pills-shipping"
                            role="tab" aria-controls="v-pills-shipping" aria-selected="false">Shipping</a>
                        <a class="nav-link" id="v-pills-attributes-tab" data-toggle="pill" href="#v-pills-attributes"
                            role="tab" aria-controls="v-pills-attributes" v-show="variant == 'simple'"
                            aria-selected="false">Attributes</a>
                        <a class="nav-link" id="v-pills-variable-tab" data-toggle="pill" href="#v-pills-variable"
                            role="tab" aria-controls="v-pills-variable" v-show="variant == 'variable'"
                            aria-selected="false">Attributes</a>
                        <a class="nav-link" id="v-pills-Dimensions-tab" data-toggle="pill" href="#v-pills-Dimensions"
                            role="tab" aria-controls="v-pills-Dimensions" aria-selected="false">Dimensions</a>
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings"
                            role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel"
                            aria-labelledby="v-pills-general-tab">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="product_type" class=" control-label">Product type</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="product_type" v-model="variant" @change="variations"
                                            class="form-control">
                                            <option disabled value="">product_type</option>
                                            <option value="simple">Simple</option>
                                            <option value="variable">Variable</option>
                                        </select> </div>
                                </div>
                                <div class="form-group row" v-for="(lng, localeCode) in langs" :key="'name'+localeCode">
                                    <div class="col-md-3">
                                        <label for="name" class=" control-label">Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" v-if="localeCode == 'en'" @keyup="changeSlug" :name="'name_'+localeCode" class="form-control"
                                            :placeholder="'Name ' + lng['name']">
                                        <input type="text" v-else :name="'name_'+localeCode" class="form-control"
                                               :placeholder="'Name ' + lng['name']">
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="name" class=" control-label">Slug</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="slug" class="form-control"
                                            placeholder="Slug" v-model="slug">
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="sku" class=" control-label">Sku</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="sku" class="form-control" placeholder="Sku">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="image" class=" control-label">Main Image</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                            <input type="file" class="custom-file-input" id="customFile" name="image">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="image" class=" control-label">Gallery</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                            <input type="file" class="custom-file-input" id="customFile1" name="gallery[]" multiple>
                                            <label class="custom-file-label" for="customFile1">Choose file</label>
                                        </div>
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
                                        <select name="user_id" class="form-control">
                                            <option v-for="seller in sellers" :value="seller.id">{{seller.email}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="Section" class=" control-label">Product Section in Homepage</label>
                                    </div>
                                    <div class="col-md-9">
                                            <select name="section" class="form-control" required>
                                                <option value="none">None</option>
                                                <option value="hot_new_arrivals">Hot New arrivals section</option>
                                                <option value="trending_now">Trending Now</option>
                                                <option value="make_dreams_your_reality">Make dreams your reality</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-inventory" role="tabpanel"
                            aria-labelledby="v-pills-inventory-tab">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="stock" class=" control-label">Stock quantity</label>
                                </div>
                                <div class="col-md-9">
                                    <input name="stock" type="number" class="form-control" placeholder="Stock quantity">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="purchase_price" class=" control-label">Purchase price</label>
                                </div>
                                <div class="col-md-9">
                                    <input name="purchase_price" type="number" class="form-control" step="0.00"
                                        placeholder="Purchase price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="sale_price" class=" control-label">Regular price</label>
                                </div>
                                <div class="col-md-9">
                                    <input name="sale_price" type="number" class="form-control" step="0.00"
                                        placeholder="Regular price">
                                </div>
                            </div>
                            <div class="form-group row" v-for="(lng, localeCode) in langs"
                                :key="'Description'+localeCode">
                                <div class="col-md-3">
                                    <label for="description" class=" control-label">Description in
                                        {{lng['name']}}</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea :name="'description_'+localeCode" class="form-control"
                                        :placeholder="'description in '+ lng['name']"
                                        :id="'description_'+localeCode"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="category_id" class=" control-label">Category</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="category_id" class="form-control" v-for="category in categories"
                                        :key="category.id">
                                        <option disabled value="" selected>Category</option>
                                        <option :value="category.id"> {{category.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="tradmark_id" class=" control-label">Brands</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="tradmark_id" class="form-control" v-for="brand in brands"
                                        :key="brand.id">
                                        <option disabled value="" selected>Brand</option>
                                        <option :value="brand.id"> {{brand.name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-shipping" role="tabpanel"
                            aria-labelledby="v-pills-shipping-tab">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="tax" class=" control-label">Tax</label>
                                </div>
                                <div class="col-md-9">
                                    <input name="tax" type="number" class="form-control" step="0.00" placeholder="tax">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="shipping_id" class=" control-label">shipping</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple" style="width:100%;" name="shippings[]"
                                            multiple="multiple">
                                        <option v-for="attribute in data" :key="attribute.id" :value="attribute.id">{{attribute.zone.name+' / '+attribute.shippingcompany.name[lang]+' / '+attribute.name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-attributes" v-show="variant == 'simple'" role="tabpanel"
                            aria-labelledby="v-pills-attributes-tab">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="size" class=" control-label">size</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="size" class="form-control" placeholder="size">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="color" class=" control-label">color</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="color" class="form-control" placeholder="color">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                            aria-labelledby="v-pills-settings-tab">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="in_stock" class=" control-label">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="in_stock" class="form-control">
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
                                    <select name="visible" class="form-control">
                                        <option disabled value="" selected>visible</option>
                                        <option value="visible">Visible</option>
                                        <option value="hidden">Hidden</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-variable" role="tabpanel"
                            aria-labelledby="v-pills-variable-tab" v-show="variant == 'variable'">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="attributes" class="control-label">Attributes</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple" style="width:100%;" name="attributes[]"
                                        multiple="multiple">
                                        <option v-for="attribute in attributes" :key="attribute.id"
                                            :value="attribute.id">{{attribute['name'][lang]}}</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                        </div>
                        <div class="tab-pane fade" id="v-pills-Dimensions" role="tabpanel"
                            aria-labelledby="v-pills-Dimensions-tab">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="Dimensions" class=" control-label">Dimensions</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="length" class="form-control mb-4"
                                            placeholder="length">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="width" class="form-control mb-4"
                                            placeholder="width">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="height" class="form-control mb-4"
                                            placeholder="height">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="weight" class="form-control mb-4"
                                            placeholder="weight">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

        </form>
    </div>
</template>

<script>
    export default {
        name: 'create-product',
        props: ['route', 'categories','data', 'brands', 'lang', 'shippings', 'langs', 'attributefamily','sellers', 'aurl', 'attributes'],
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                category: {
                    id: '',
                    name: ''
                },
                brand: {
                    id: '',
                    name: ''
                },
                shipping: {
                    id: '',
                    ['name_' + this.lang]: '',
                },
                variant: 'simple',
                variables: 'custom',
                chractersVariable: [],
                Variables: [],
                attributesFamily: '',
                selectedTags: [],
                selectedValue:[],
                slug:'',
                owner: 'for_site_owner'
            }
        },
        /* computed: {
             filteredTags() {
                 let tags = this.selectedTags
                     tags = tags.filter((p) => {
                         return p.value.indexOf(this.selectedTags) !== -1
                     })
                 return tags
             }
         },*/
        created() {
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
            changeSlug({target}) {
                this.slug = target.value.split(' ').join('-')
            }
        }
    }

</script>
