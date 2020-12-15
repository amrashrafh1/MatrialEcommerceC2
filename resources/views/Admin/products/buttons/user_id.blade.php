<a href="{{route('show_app', $seller_id)}}">
{{($model->store)?Str::limit($model->store->name,30):trans('admin.empty')}}</a>
