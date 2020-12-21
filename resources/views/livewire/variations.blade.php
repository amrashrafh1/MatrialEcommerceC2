<div id="create-variations">
    <div id="loading" wire:loading>
        <div class="loader"></div>
    </div>
    <form action="{{route('store_variations', $this->product->id)}}" method="post" wire:ignore.self>
        @csrf
        <div class="pull-right">
            @if(count($this->variations) > 0)
            <div class='alert alert-success'>{{count($this->variations)}}
                @lang('admin.variations_was_created_successfuly')
            </div>
            @endif
            <div>
                <button class="btn btn-success" wire:click.prevent='infinity' data-toggle="tooltip" data-placement="top"
                    title="
                @lang('admin.create_variations_from_all_attributes')"><i class="fa fa-infinity fa-2x"></i></button>
                <button class="btn btn-primary" wire:click.prevent='addRaw'><i class="fa fa-plus fa-2x"></i></button>
            </div>

        </div>

        @foreach($this->variations as $index => $variation)
        <div class="md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

            <!-- Accordion card -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header" role="tab" id="heading{{$index}}">
                    <div class='pull-right'>
                        <button class="btn btn-danger" wire:click.prevent='deleteRaw({{$index}})' data-toggle="tooltip"
                            data-placement="top" title="@lang('admin.delete')"><i
                                class="fa fa-trash"></i></button>
                    </div>
                    <h5 class="mb-0">
                            <a class='open_close' data-toggle="collapse" data-parent="#accordionEx" href="#variations{{$index}}"
                                aria-expanded="true" aria-controls="variations{{$index}}">
                                <span> close </span>  <i class="fas fa-angle-up rotate-icon"></i>

                            </a>
                            <div class="row">
                                @foreach($family as $indx => $fam)
                                <div class="form-group col-3">
                                    <h3>{{$fam->name}}</h3>
                                    <select name="variations[]" class="form-control" required>
                                        <option value="">@lang('admin.empty')</option>
                                        @foreach($fam->attributes as $attr)
                                        <option {{($variation[$indx] == $attr->id) ?'selected':''}}
                                            value="{{$attr->id}}">{{$attr->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endforeach
                            </div>
                        </h5>
                </div>
                <!-- Card body -->
                <div id="variations{{$index}}" class="collapse show" role="tabpanel" aria-labelledby="heading{{$index}}"
                    data-parent="#accordionEx">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.sku')</label>

                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="sku[]" placeholder="@lang('admin.sku')"
                                    value='{{$product->sku}}'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.sale_price')</label>

                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="number" step="00.01" placeholder="0.00"
                                    name="sale_price[]" value='{{$product->sale_price}}'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.purchase_price')</label>

                            </div>
                            <div class="col-md-8">
                                <input class="form-control" type="number" step="00.01" placeholder="0.00"
                                    name="purchase_price[]" value='{{$product->purchase_price}}'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.stock')</label>

                            </div>
                            <div class="col-md-8">
                                <input class="form-control" name="stock[]" type="number"
                                    placeholder="@lang('admin.stock')" value='{{$product->stock}}'>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">@lang('admin.in_stock')</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" name="in_stock[]" required>
                                    <option value="in_stock" {{$product->in_stock == 'in_stock'?'selected':''}}>
                                        @lang('admin.in_stock')</option>
                                    <option value="out_stock" {{$product->in_stock == 'out_stock'?'selected':''}}>
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
                                    <option value="visible" {{$product->visible == 'visible'?'selected':''}}>
                                        @lang('admin.visible')</option>
                                    <option value="hidden" {{$product->visible == 'hidden'?'selected':''}}>
                                        @lang('admin.hidden')</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Accordion card -->

            <!-- Accordion card -->
        </div>
        @endforeach
        <input type="submit" class="btn btn-success" value="@lang('admin.save')">
    </form>
</div>

@push('js')
<script>
    $('a.open_close').click(function(){
    $(this).find('i').toggleClass('fa-angle-down fa-angle-up');

    if ($(this).find('span').text() === "{{trans('admin.open')}}") {
        $(this).find('span').text("{{trans('admin.close')}}");
    } else {
        $(this).find('span').text("{{trans('admin.open')}}");
    }
});
</script>
@endpush
<style>
    #create-variations {
        min-height:600px;
        position:relative;
    }
    #loading {
    position: absolute;
    width: 100%;
    height: 100%;
    background: #EEEEEE;
    opacity: 0.8;
    top: 0;
    right: 0;
    left:0;
    bottom: 0;
    z-index:9999;
    }

    .loader {
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        margin: 20% auto;

    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
