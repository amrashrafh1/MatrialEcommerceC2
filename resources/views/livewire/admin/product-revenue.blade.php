<div class="col-lg-6 col-md-12">
    <div class="card">
        <div class="card-header card-header-warning">
            <h4 class="card-title">@lang('admin.top_products_by_revenue')</h4>
            <span class="card-category">{{Carbon\Carbon::today()->diffForHumans()}}</span>
            <span class="float-right">
                <select wire:model='sort' class='form-control'>
                    <option value='days'>@lang('user.daily')</option>
                    <option value='months'>@lang('user.monthly')</option>
                    <option value='years'>@lang('user.yearly')</option>
                </select>
            </span>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="text-warning">
                    <th>#</th>
                    <th>@lang('admin.name')</th>
                    <th>@lang('admin.product_revenue')</th>
                    <th>@lang('admin.purchases')</th>
                    <th>@lang('admin.unique_visits')</th>
                </thead>
                <tbody>

                    @foreach($products_revenue as $revenue)
                    <tr>
                        <td>{{$revenue->product->id}}</td>
                        <td><a href="{{route('products.edit', $revenue->product->id)}}">{{$revenue->product->name}}</a>
                        </td>
                        <td>${{$revenue->revenue}}</td>
                        <td>{{$revenue->purchases}}</td>
                        <td>{{views($revenue->product)->unique()->remember(now()->addHours(6))->count()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
