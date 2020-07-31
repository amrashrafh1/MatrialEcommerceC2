<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('user.sub_total')</th>
                <th scope="col">@lang('user.grand_total')</th>
                <th scope="col">@lang('user.status')</th>
                <th scope="col">@lang('user.billed_to')</th>
                <th scope="col">@lang('user.shipping_to')</th>
                <th scope="col">@lang('user.order_date')</th>
                <th scope="col">@lang('user.show')</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <th scope="row">{{$order->id}}</th>
                <td>{!! $order->sub_total !!}</td>
                <td>{!! $order->grand_total !!}</td>
                <td>{{$order->status}}</td>
                <td>{{$order->billing_address}}</td>
                <td>{{$order->shipping_address}}</td>
                <td>{{$order->created_at}}</td>
                <td><a class='btn btn-primary' href='{{route('profile.order.show',$order->id)}}'>
                    <i class='fa fa-eye'></i> @lang('user.show')</a></td>
            </tr>
            @empty
            <tr>
                <td>
                    @lang('user.empty')
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {!! $orders->links() !!}

</div>
