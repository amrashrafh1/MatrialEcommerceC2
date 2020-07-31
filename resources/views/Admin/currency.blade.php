@extends('Admin.layouts.app', ['activePage' => 'Currencies', 'titlePage' => trans('admin.currencies')])
@section('content')
    <div class="container-fluid mt-6 pt-8">
        <div class="col-md-12">
                <div class="container-fluid mt-6 pt-8">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">{{$title}} @lang('Table')</h4>
                                <p class="card-description text-">@lang('admin.dollar_foreign_exchange_rates') (@lang('admin.date') : @lang('admin.1_Hour_ago')</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                        <th>
                                            @lang('admin.currency')
                                        </th>
                                        <th>
                                            @lang('admin.code')
                                        </th>
                                        <th>
                                            @lang('admin.rate')
                                        </th>
                                        <th>
                                            @lang('admin.enable')
                                        </th>
                                        </thead>
                                        <tbody>
                                        @foreach($data as  $key => $j)
                                            <tr>
                                                <td>
                                                    {{ $j['name'] }}
                                                </td>
                                                <td>
                                                    {{ $j['code'] }}
                                                </td>
                                                <td>
                                                    {{$j['exchange_rate']}}
                                                </td>
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
                                                            <form class="form" action="{{ url(\LaravelLocalization::setLocale().'/admin/enable/currency/' . $j['code'])}}" enctype="multipart/form-data">
                                                            @csrf
                                                                <input class="checkInput" name="enable" {{($j['active'] == 0)?'':'checked'}}   type="checkbox" data-toggle="toggle">
                                                            </form>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @push('js')
            <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
            <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
            <script>
                $('.checkInput').on('change', function () {
                    $(this).parents('form:first').trigger('submit');
                   //console.log(form);
                });
                $('.form').on('submit', function (e) {
                    e.preventDefault();
                    $route = $(this).attr('action');
                    const formData = $(this).serialize();
                    console.log(formData);
                    axios.post($route, formData)
                        .then(res => {});
                });
                </script>
    @endpush
@endsection
