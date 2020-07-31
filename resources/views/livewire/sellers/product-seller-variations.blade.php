@php
$productAttributes = $this->product->attributes()->select('id')->get();
@endphp
<div id="create-variations">
<div class="text-right mb-3">
    <button class="btn btn-primary" @click="addRow"><i class="fa fa-plus fa-2x"></i></button>
</div>
<form action="{{route('seller_frontend_products_variations', $this->product->slug)}}" method="post">
    @csrf

    <div class="md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

        <!-- Accordion card -->
        <div class="card">

            <!-- Card header -->
            <div class="card-header" role="tab" id="headingOne1">
                <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                    aria-controls="collapseOne1">
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
                    </h5>
                </a>
            </div>

            <!-- Card body -->
            <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
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

        <!-- Accordion card -->
        <div class="card" v-for="(input, index) in inputs" :key="index">
<div class="pull-right">
    <button class="btn btn-danger btn-sm" @click.prevent='deleteRow(index)'> <i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @lang('admin.create_variations_from_all_attributes')
      </div>
      <div class="modal-footer">
        <form  >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin.close')</button>
        <input type="submit" class="btn btn-primary" value="@lang('admin.approval')">
        </form>
      </div>
    </div>
  </div>
</div>
</div>

@push('js')
<script>
    var vuejs = new Vue({
        el:'#create-variations',
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
