<div class="row">
    <div class="col-md-12">
        <form method="post" enctype="multipart/form-data"
            action="{{ route('user_profile.update') }}" autocomplete="off"
            class="form-horizontal">
            @csrf
            @method('put')
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">@lang('user.Edit_Profile')</h4>
                    <p class="card-category">@lang('user.User_information')</p>
                </div>
                <div class="card-body ">
                    @if (session('status'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span>{{ session('status') }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <label class="col-sm-2 col-form-label">@lang('user.name')</label>
                        <div class="col-sm-7">
                            <div
                                class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <input
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" id="input-name" type="text"
                                    placeholder="@lang('user.name')"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    required="true" aria-required="true" />
                                @if ($errors->has('name'))
                                <span id="name-error" class="error text-danger"
                                    for="input-name">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label
                            class="col-sm-2 col-form-label">{{ trans('user.last_name') }}</label>
                        <div class="col-sm-7">
                            <div
                                class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                <input
                                    class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                    name="last_name" id="input-last_name" type="text"
                                    placeholder="{{ trans('user.last_name') }}"
                                    value="{{ old('last_name', auth()->user()->last_name) }}"
                                    required />
                                @if ($errors->has('last_name'))
                                <span id="email-error" class="error text-danger"
                                    for="input-last_name">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">@lang('user.email')</label>
                        <div class="col-sm-7">
                            <div
                                class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <input
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" id="input-email" type="email"
                                    placeholder="@lang('user.email')"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    required />
                                @if ($errors->has('email'))
                                <span id="email-error" class="error text-danger"
                                    for="input-email">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label
                            class="col-sm-2 col-form-label">@lang('user.address')</label>
                        <div class="col-sm-7">
                            <div
                                class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                <input
                                    class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                    name="address" id="input-address" type="text"
                                    placeholder="@lang('user.address')"
                                    value="{{ old('address', auth()->user()->address) }}"
                                    required />
                                @if ($errors->has('email'))
                                <span id="email-error" class="error text-danger"
                                    for="input-email">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{Storage::url(auth()->user()->image)}}"
                                style="width:300px; border-radius: 20%;">
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-2">
                            {!!
                            Form::label('image',trans('admin.image'),['class'=>'control-label'])
                            !!}
                        </div>
                        <div class="col-md-10">
                            <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                <input type="file" class="custom-file-input"
                                    id="customFile" name="image">
                                <label class="custom-file-label" for="customFile">Choose
                                    file</label>
                            </div>
                            @if ($errors->has('image'))
                            <span id="email-error" class="error text-danger"
                                for="input-image">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit"
                        class="btn btn-primary">@lang('user.save')</button>
                </div>
            </div>
        </form>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('user_profile.password') }}"
            class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">@lang('user.Change_password')</h4>
                    <p class="card-category">@lang('user.password')</p>
                </div>
                <div class="card-body ">
                    @if (session('status_password'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span>{{ session('status_password') }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <label class="col-sm-2 col-form-label"
                            for="input-current-password">@lang('user.curent_password')</label>
                        <div class="col-sm-7">
                            <div
                                class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                <input
                                    class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                    input type="password" name="old_password"
                                    id="input-current-password"
                                    placeholder="@lang('user.curent_password')" value=""
                                    required />
                                @if ($errors->has('old_password'))
                                <span id="name-error" class="error text-danger"
                                    for="input-name">{{ $errors->first('old_password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label"
                            for="input-password">@lang('user.new_password')</label>
                        <div class="col-sm-7">
                            <div
                                class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <input
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" id="input-password" type="password"
                                    placeholder="@lang('user.new_password')" value=""
                                    required />
                                @if ($errors->has('password'))
                                <span id="password-error" class="error text-danger"
                                    for="input-password">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label"
                            for="input-password-confirmation">@lang('user.Confirm_New_Password')</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input class="form-control" name="password_confirmation"
                                    id="input-password-confirmation" type="password"
                                    placeholder="@lang('user.Confirm_New_Password')"
                                    value="" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit"
                        class="btn btn-primary">@lang('user.Change_password')</button>
                </div>
            </div>
        </form>
    </div>
</div>
