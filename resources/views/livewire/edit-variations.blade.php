<div id="edit-variations">
    @php
    $productAttributes = $this->product->attributes()->select('id')->get();
    @endphp
    <form action="{{route('update_variations', $this->product->id)}}" method="post">
        @csrf
        <div class="pull-right">
            <button class="btn btn-primary" @click="addRow"><i class="fa fa-plus fa-2x"></i></button>

        </div>

        <div class="md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

            <!-- Accordion card -->
            @foreach($variations as $variation)
            @php
            $attr_variation = $variation->attributes()->select('id')->get();
            @endphp
            <input type="hidden" name="variation_id[]" value="{{$variation->id}}">

            <div class="card">
                <div class="pull-right">
                    <button class="btn btn-danger btn-sm" wire:click.prevent="delete_variation({{$variation->id}})"> <i
                            class="fa fa-trash"></i></button>
                </div>
                <!-- Card header -->
                <div class="card-header" role="tab" id="headingOne1">
                    <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne{{$variation->id}}"
                        aria-expanded="true" aria-controls="collapseOne{{$variation->id}}">
                        <h5 class="mb-0">

                            <div class="row">
                                @foreach($family as $fam)
                                <div class="form-group col-3">
                                    <h3>{{$fam->name}}</h3>
                                    <select name="variations[]" class="form-control" required>
                                        <option value="">@lang('admin.empty')</option>
                                        @foreach($fam->attributes as $attr)
                                        @if($productAttributes->pluck('id')->contains($attr->id))
                                        <option value="{{$attr->id}}"
                                            {{($attr_variation->pluck('id')->contains($attr->id))?'selected':''}}>
                                            {{$attr->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                @endforeach
                            </div>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>

                <!-- Card body -->
                <div id="collapseOne{{$variation->id}}" class="collapse show" role="tabpanel"
                    aria-labelledby="headingOne1" data-parent="#accordionEx">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.sku')</label>
                                <span class="pull-right text-primary">(@lang('admin.optional'))</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="sku[]" value="{{$variation->sku}}"
                                    placeholder="@lang('admin.sku')">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.sale_price')</label>
                                <span class="pull-right text-primary">(@lang('admin.optional'))</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="number" step="00.01" placeholder="0.00"
                                    name="sale_price[]" value="{{$variation->sale_price}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.purchase_price')</label>
                                <span class="pull-right text-primary">(@lang('admin.optional'))</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="number" step="00.01" placeholder="0.00"
                                    name="purchase_price[]" value="{{$variation->purchase_price}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.stock')</label>
                                <span class="pull-right text-primary">(@lang('admin.optional'))</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" name="stock[]" type="number"
                                    placeholder="@lang('admin.optional')" value="{{$variation->stock}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.in_stock')</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="in_stock[]" required>
                                    <option value="in_stock" {{($variation->in_stock === 'in_stock')?'selected':''}}>
                                        @lang('admin.in_stock')</option>
                                    <option value="out_stock" {{($variation->in_stock === 'out_stock')?'selected':''}}>
                                        @lang('admin.out_stock')</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.visible')</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="visible[]" required>
                                    <option value="visible" {{($variation->in_stock === 'visible')?'selected':''}}>
                                        @lang('admin.visible')</option>
                                    <option value="hidden" {{($variation->in_stock === 'hidden')?'selected':''}}>
                                        @lang('admin.hidden')</option>
                                </select> </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Accordion card -->
            @endforeach
            <!-- Accordion card -->
            <div class="card" v-for="(input, index) in inputs" :key="index">
                <div class="pull-right">
                    <button class="btn btn-danger btn-sm" @click.prevent='deleteRow(index)'> <i
                            class="fa fa-trash"></i></button>
                </div>
                <!-- Card header -->
                <div class="card-header" role="tab" id="headingTwo2">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" :href="'#collapseTwo2'+index"
                        aria-expanded="false" :aria-controls="'collapseTwo2'+index">
                        <h5 class="mb-0">

                            <div class="row">
                                @foreach($family as $fam)
                                <div class="form-group col-3">
                                    <h3>{{$fam->name}}</h3>
                                    <select name="variations[]" class="form-control" required>
                                        <option value="">@lang('admin.empty')</option>
                                        @foreach($fam->attributes as $attr)
                                        @if($productAttributes->pluck('id')->contains($attr->id))
                                        <option value="{{$attr->id}}">{{$attr->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                @endforeach
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
                                <label class="form-label">@lang('admin.sku')</label>
                                <span class="pull-right text-primary">(@lang('admin.optional'))</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="sku[]" placeholder="@lang('admin.sku')">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.sale_price')</label>
                                <span class="pull-right text-primary">(@lang('admin.optional'))</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="number" step="00.01" placeholder="0.00"
                                    name="sale_price[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.purchase_price')</label>
                                <span class="pull-right text-primary">(@lang('admin.optional'))</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="number" step="00.01" placeholder="0.00"
                                    name="purchase_price[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.stock')</label>
                                <span class="pull-right text-primary">(@lang('admin.optional'))</span>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" name="stock[]" type="number"
                                    placeholder="@lang('admin.optional')">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.in_stock')</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="in_stock[]" required>
                                    <option value="in_stock">@lang('admin.in_stock')</option>
                                    <option value="out_stock">@lang('admin.out_stock')</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.visible')</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="visible[]" required>
                                    <option value="visible">@lang('admin.visible')</option>
                                    <option value="hidden">@lang('admin.hidden')</option>
                                </select> </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- Accordion card -->
        </div>
        <input type="submit" class="btn btn-success" value="@lang('admin.save')">
    </form>
    <!-- Modal -->
</div>
@push('js')
<script>
    var vuejs = new Vue({
        el: '#edit-variations',
        data() {
            return {
                inputs: [],
            }
        },
        methods: {
            addRow(e) {
                e.preventDefault();
                this.inputs.push({
                    one: ''
                });
            },
            deleteRow(index) {
                //e.preventDefault();
                this.inputs.splice(index, 1)
            }
        }
    });

</script>

@endpush
