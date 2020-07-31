<template>
    <!--Accordion wrapper-->
    <form :action="route" method="post">
        <input type="hidden" :value="csrf" name="_token">

        <div class="pull-right">
            <button class="btn btn-primary" v-on:click="addRow"><i class="fa fa-plus fa-2x"></i></button>
            <button class="btn btn-primary" v-on:click="allVariations" data-toggle="modal" data-target="#basicExampleModal"><i class="fa fa-infinity"></i></button>

        </div>

        <div class="md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

            <!-- Accordion card -->
            <div class="card">

                <!-- Card header -->
                <div class="card-header" role="tab" id="headingOne1">
                    <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                        aria-controls="collapseOne1">
                        <h5 class="mb-0">

                            <div class="row">
                                <div class="form-group col-3" v-for="fam in family" :key="fam.id">
                                    <h3>{{fam.name[locale]}}</h3>
                                    <select name="variations[]" class="form-control">
                                        <option value="">{{translations[locale+'.admin']['empty']}}</option>
                                        <option v-for="attr in attributes" :key="attr.id + fam.id" :value="attr.id" v-if="fam.id == attr.family_id">{{attr.name[locale]}}</option>
                                    </select>
                                </div>
                            </div>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>

                <!-- Card body -->
                <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                    data-parent="#accordionEx">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['sku']}}</label>
                                <span class="pull-right text-primary">({{translations[locale+ '.admin']['optional']}})</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="sku[]" :placeholder="translations[locale+ '.admin']['sku']">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['sale_price']}}</label>
                                <span class="pull-right text-primary">({{translations[locale+ '.admin']['optional']}})</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="number" step="00.01" placeholder="0.00"
                                    name="sale_price[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['purchase_price']}}</label>
                                <span class="pull-right text-primary">({{translations[locale+ '.admin']['optional']}})</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="number" step="00.01" placeholder="0.00"
                                    name="purchase_price[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['stock']}} </label>
                                <span class="pull-right text-primary">({{translations[locale+ '.admin']['optional']}})</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" name="stock[]" type="number"
                                    :placeholder="translations[locale+ '.admin']['stock']">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['in_stock']}}</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="in_stock[]">
                                    <option value="in_stock">{{translations[locale+ '.admin']['in_stock']}}</option>
                                    <option value="out_stock">{{translations[locale+ '.admin']['out_stock']}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['visible']}}</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="visible[]">
                                    <option value="visible">{{translations[locale+ '.admin']['visible']}}</option>
                                    <option value="hidden">{{translations[locale+ '.admin']['hidden']}}</option>
                                </select> </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Accordion card -->

            <!-- Accordion card -->
            <div class="card" v-for="(input, index) in inputs" :key="index">

                <!-- Card header -->
                <div class="card-header" role="tab" id="headingTwo2">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" :href="'#collapseTwo2'+index"
                        aria-expanded="false" :aria-controls="'collapseTwo2'+index">
                        <h5 class="mb-0">
                            <div class="row">
                                <div class="form-group col-3" v-for="fam in family" :key="fam.id">
                                    <h3>{{fam.name[locale]}}</h3>
                                    <select name="variations[]" class="form-control">
                                        <option value="">{{translations[locale+'.admin']['empty']}}</option>
                                        <option v-for="attr in attributes" :key="attr.id + fam.id" :value="attr.id" v-if="fam.id == attr.family_id">{{attr.name[locale]}}</option>
                                    </select>
                                </div>
                            </div>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>

                <!-- Card body -->
                <div :id="'collapseTwo2'+index" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                    data-parent="#accordionEx">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['sku']}}</label>
                                <span class="pull-right text-primary">({{translations[locale+ '.admin']['optional']}})</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="sku[]" :placeholder="translations[locale+ '.admin']['sku']">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['sale_price']}}</label>
                                <span class="pull-right text-primary">({{translations[locale+ '.admin']['optional']}})</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="number" step="00.01" placeholder="0.00"
                                    name="sale_price[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['purchase_price']}}</label>
                                <span class="pull-right text-primary">({{translations[locale+ '.admin']['optional']}})</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="number" step="00.01" placeholder="0.00"
                                    name="purchase_price[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['stock']}} </label>
                                <span class="pull-right text-primary">({{translations[locale+ '.admin']['optional']}})</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" name="stock[]" type="number"
                                    :placeholder="translations[locale+ '.admin']['stock']">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['in_stock']}}</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="in_stock[]">
                                    <option value="in_stock">{{translations[locale+ '.admin']['in_stock']}}</option>
                                    <option value="out_stock">{{translations[locale+ '.admin']['out_stock']}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">{{translations[locale+ '.admin']['visible']}}</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="visible[]">
                                    <option value="visible">{{translations[locale+ '.admin']['visible']}}</option>
                                    <option value="hidden">{{translations[locale+ '.admin']['hidden']}}</option>
                                </select> </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- Accordion card -->
        </div>
        <input type="submit" class="btn btn-success" :value="translations[locale+ '.admin']['save']">
    </form>
</template>

<script>
import translations from '../../../../../public/messages.json';
Vue.prototype.$translations = translations;
    export default {
        name: 'variations-product',
        props: ['locale', 'attributes', 'family', 'route'],
        data() {
            return {
                inputs: [],
                translations:'',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        created() {
            this.translations = translations;
        },
        methods: {
            lang()
                {
                    console.log(translations[this.locale+ '.admin'].sale_price);
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
            allVariations(e, index) {
                e.preventDefault();
                this.inputs.splice(index, 1)
            },
        }

    }

</script>
