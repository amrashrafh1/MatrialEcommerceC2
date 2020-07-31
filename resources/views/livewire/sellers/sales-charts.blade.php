<div class="row">
<div class="col-xl-6">
    <div class="card  shadow overflow-hidden">
        <div class="card-header bg-transparent ">
            <div class="row align-items-center" wire:ignore>
                <div class="col">
                    <div class="row text-uppercase text-black ls-1 mb-1">
                        <h6 class="col-sm-6">Overview</h6>
                        <div class="col-sm-6 form-group text-right">
                            <select wire:model='period'>
                                <option value="days">@lang('user.daily')</option>
                                <option value="months">@lang('user.monthly')</option>
                                <option value="years">@lang('user.yearly')</option>
                            </select>
                        </div>
                    </div>
                    <h2 class="mb-0">@lang('user.Details_Of_Sales')</h2>
                </div>

            </div>
        </div>
        <div class="card-body">
            <!-- Chart -->
            {!! $chart->container() !!}
       </div>
    </div>
</div>
<div class="col-xl-6">
    <div class="card  shadow overflow-hidden">
        <div class="card-header bg-transparent ">
            <div class="row align-items-center" wire:ignore>
                <div class="col">
                    <div class="row text-uppercase text-black ls-1 mb-1">
                        <h6 class="col-sm-6">@lang('user.Overview')</h6>
                        <div class="col-sm-6 form-group text-right">
                            <select wire:model='profits'>
                                <option value="days">@lang('user.daily')</option>
                                <option value="months">@lang('user.monthly')</option>
                                <option value="years">@lang('user.yearly')</option>
                            </select>
                        </div>
                    </div>
                    <h2 class="mb-0">@lang('user.Details_Of_revenue')</h2>
                </div>

            </div>
        </div>
        <div class="card-body">
            <!-- Chart -->
            {!! $reveune->container() !!}
       </div>
    </div>
</div>
</div>
@push('js')
<script src="{{url('/')}}/js/chart.js/dist/Chart.min.js"></script>
{!! $chart->script() !!}
{!! $reveune->script() !!}
@endpush
