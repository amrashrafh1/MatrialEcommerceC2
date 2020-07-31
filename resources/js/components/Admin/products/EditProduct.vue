<template>
    <div class="col-md-12">
        <form :action="route" id="users" enctype="multipart/form-data" class="form-horizontal form-row-seperated"
            method="post">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="_method" value="PATCH">
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
                        <a class="nav-link" id="v-pills-Attributes-tab" data-toggle="pill" href="#v-pills-Attributes"
                            role="tab" aria-controls="v-pills-Attributes" v-show="variant != 'simple'"
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
                                        <input type="text" :name="'name_'+localeCode" class="form-control"
                                            :placeholder="'Name ' + lng['name']" :value="product['name'][localeCode]">
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="name" class=" control-label">Slug</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="slug" class="form-control"
                                            placeholder="Slug" :value="product['slug']">
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="sku" class=" control-label">Sku</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="sku" class="form-control" placeholder="Sku" :value="product['sku']">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="image" class=" control-label">Main Image</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class=" img-responsive">
                                            <img v-if="image" :src="image" class="image"/>
                                            <img v-else :src="image" class="image"/>
                                        </div>
                                        <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                            <input type="file" class="custom-file-input" id="customFile" name="image">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
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
                                        <select name="user_id" :value="product['user_id']" class="form-control">
                                            <option v-for="seller in sellers" :value="seller.id">{{seller.email}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="Section" class=" control-label">Product Section in Homepage</label>
                                    </div>
                                    <div class="col-md-9">
                                            <select name="section" :value="product['section']" class="form-control" required>
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
                                    <input name="stock" type="number" class="form-control"
                                        placeholder="Stock quantity" :value="product['stock']">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="purchase_price" class=" control-label">Purchase price</label>
                                </div>
                                <div class="col-md-9">
                                    <input name="purchase_price" type="number" class="form-control" step="0.00"
                                        placeholder="Purchase price" :value="product['purchase_price']">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="sale_price" class=" control-label">Regular price</label>
                                </div>
                                <div class="col-md-9">
                                    <input name="sale_price" type="number" class="form-control" step="0.00"
                                        placeholder="Regular price" :value="product['sale_price']">
                                </div>
                            </div>
                            <div class="form-group row" v-for="(lng, localeCode) in langs"
                                :key="'Description'+localeCode">
                                <div class="col-md-3">
                                    <label for="description" class=" control-label">Description in
                                        {{lng['name']}}</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea v-if="product['description']" :name="'description_'+localeCode" class="form-control"
                                        :placeholder="'description in '+ lng['name']"
                                        :id="'description_'+localeCode" :value="product['description'][localeCode]"></textarea>
                                        <textarea v-else :name="'description_'+localeCode" class="form-control"
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
                                        <option :value="category.id" v-if="product['category_id'] == category.id" selected> {{category.name[lang]}}</option>
                                        <option :value="category.id" v-else> {{category.name}}</option>

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
                                        <option :value="brand.id" v-if="product['tradmark_id'] == brand.id" selected> {{brand.name[lang]}}</option>
                                        <option :value="brand.id" v-else> {{brand.name}}</option>
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
                                    <input name="tax" type="number" class="form-control" step="0.00" placeholder="tax" :value="product['tax']">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="shipping_id" class=" control-label">shipping</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple" style="width:100%;" name="shippings[]"
                                            multiple="multiple">
                                        <option  v-for="(attribute, index) in data" :key="attribute.id"  :value="attribute.id">{{attribute.zone.name+' / '+attribute.shippingcompany.name[lang]+' / '+attribute.name}}</option>
                                    </select>
                                    <h4 class="mt-2">Product shippings</h4>
                                    <ul>
                                        <li v-for="method in shippingmethods" :key="method.id">{{method.zone.name+' / '+method.shippingcompany.name[lang]+' / '+method.name}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-attributes" v-show="variant == 'simple'" role="tabpanel"
                            aria-labelledby="v-pills-attributes-tab">
                            <div class="form-group row" v-for="(lng, localeCode) in langs"
                                :key="'size'+localeCode">
                                <div class="col-md-3">
                                    <label for="size" class=" control-label">size</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" :name="'size_'+localeCode" class="form-control" :placeholder="'size in '+ lng['name']"  v-if="product['size']" :value="product['size'][localeCode]">
                                    <input type="text" :name="'size_'+localeCode" class="form-control" :placeholder="'size in '+ lng['name']"  v-else>
                                </div>
                            </div>
                            <div class="form-group row" v-for="(lng, localeCode) in langs"
                                :key="'color'+localeCode">
                                <div class="col-md-3">
                                    <label for="color" class=" control-label">color</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" :name="'color_'+localeCode" class="form-control" :placeholder="'color in '+ lng['name']"  v-if="product['color']" :value="product['color'][localeCode]">
                                    <input type="text" :name="'color_'+localeCode" class="form-control" :placeholder="'color in '+ lng['name']"  v-else>
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
                                        <option value="in_stock" v-if="product['in_stock'] == 'in_stock'" selected> In Stock</option>
                                        <option value="out_stock" v-if="product['in_stock'] == 'out_stock'" selected> Out Stock</option>
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
                                        <option value="visible" v-if="product['visible'] == 'visible'" selected>Visible</option>
                                        <option value="hidden"  v-if="product['visible'] == 'hidden'" selected>Hidden</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-Attributes" role="tabpanel"
                            aria-labelledby="v-pills-Attributes-tab">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="attributes" class="control-label">Attributes</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple" style="width:100%;" name="attributes[]"
                                        multiple="multiple">
                                        <option v-for="val in values" :key="val.id" :value="val.id" selected>{{val.name[lang]}}</option>
                                        <option v-for="attribute in attributes" :key="attribute.id" :value="attribute.id">{{attribute.name[lang]}}</option>
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
                                               placeholder="length" :value="product['length']">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="width" class="form-control mb-4"
                                               placeholder="width" :value="product['width']">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="height" class="form-control mb-4"
                                               placeholder="height" :value="product['height']">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="weight" class="form-control mb-4"
                                               placeholder="weight" :value="product['weight']">
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
    import axios from 'axios';
    export default {
        name: 'create-product',
        props: ['route', 'categories', 'brands','data','sellers', 'shippingmethods','lang','image', 'shippings', 'langs', 'attributefamily', 'aurl', 'attributes', 'product', 'values'],
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
                variant: this.product['product_type'],
                variables: 'custom',
                chractersVariable: [],
                Variables: [],
                attributesFamily: '',
                selectedTags: [],
                owner: this.product['owner'],
                slug:'',


            }
        },
        methods: {
            newAttributes(id) {
                for(var i = 1; i <= this.values.length; i++) {

                }
            },
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
            }
        }
    }

</script>

<style scoped>
    .image {
        width: 350px;
        height: 350px;
    }
</style>
