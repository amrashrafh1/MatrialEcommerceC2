<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">@lang('user.code')</th>
                <th scope="col">@lang('user.type')</th>
                <th scope="col">@lang('user.reward')</th>
                <th scope="col">@lang('user.quantity')</th>
                <th scope="col">@lang('user.expire_at')</th>
            </tr>
        </thead>
        <tbody>
            @forelse($coupons as $coupon)
            @if($coupon->already_used())
            <tr>
                <th scope="row">{{$coupon->code}}</th>
                <td>{{($coupon->is_usd)?currency()->getUserCurrency():trans('user.percentage')}}</td>
                <td>{!!($coupon->is_usd)?curr($coupon->reward):'%'.$coupon->reward!!}</td>
                <td>{{$coupon->quantity}}</td>
                <td>{{date('d-m-Y', strtotime($coupon->expires_at))}}</td>
            </tr>
            @endif
            @empty
            <tr>
                <td>
                    @lang('user.empty')
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {!! $coupons->links() !!}

</div>
