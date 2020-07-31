<template>
    <div>
        <div class="form-group row">
            <div class="col-md-2">
                <label for="rule" class=" control-label">{{shipping_type}}</label>

            </div>
            <div class="col-md-10">
                <select name="rule" class="form-control" v-model="rules">
                    <option disabled selected value=" ">select type</option>
                    <option v-for="(ty,index) in type" :value="index">{{ty}}</option>
                </select>
            </div>
        </div>
        <br>
        <div class="form-group row" v-if="rules == 'weight_based_per_item' || rules == 'weight_based_per_order'">
            <div class="col-md-2">
                <label for="weight" class=" control-label">weight</label>
            </div>
            <div class="col-md-10">
                <input name="weight" type="number" class="form-control" step="0.00"
                       placeholder="Max weight">
                <span>weight will be the default weight on settings</span>
            </div>
        </div>
        <div class="form-group row" v-if="rules == 'quantity_based_per_order'">
            <div class="col-md-2">
                <label for="weight" class=" control-label">{{quantity}}</label>
            </div>
            <div class="col-md-10">
                <input name="weight" type="number" class="form-control"
                       :placeholder="quantity">
            </div>
        </div>
        <br/>
    </div>
</template>

<script>
    export default {
        name: 'shipping-type',
        props: ['type', 'shipping_type', 'value', 'quantity'],
        data() {
            return {
                rules: ''
            }
        },
        methods: {
            changeRules(e) {
                this.rules = target.value;
            }

        }
    }
</script>
