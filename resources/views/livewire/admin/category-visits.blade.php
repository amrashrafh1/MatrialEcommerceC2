<div class="col-lg-6 col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">@lang('admin.top_categories_by_visits')</h4>
        <p class="card-category">{{Carbon\Carbon::today()->diffForHumans()}}</p>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-hover">
          <thead class="text-warning">
            <th>#</th>
            <th>@lang('admin.name')</th>
            <th>@lang('admin.unique_visits')</th>
          </thead>
          <tbody>
          @foreach($categories as $category)
            <tr>
              <td>{{$category->id}}</td>
              <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
              <td>{{views($category)->unique()->remember(now()->addHours(6))->count()}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
        {!! $categories->links() !!}
      </div>
    </div>
  </div>
