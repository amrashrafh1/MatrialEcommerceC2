@if( $rule === 'quantity_based_per_order'
||$rule === 'weight_based_per_order')
<a class='btn btn-primary' href='@if(count($model->rates) <= 0) {{route('methods.rates', $id)}} @else{{route('methods.rates_edit', $id)}} @endif '>@lang('admin.set_rates')</a>
@endif
