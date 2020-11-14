<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class='text-center'>@lang('user.image')</th>
                <th scope="col" class='text-center'>@lang('user.store_name')</th>
            </tr>
        </thead>
        <tbody>

            @forelse($followed as $follow)
            <tr class='text-center'>
                <th scope="row" class='text-center'>
                <a href='{{route('show_seller', $follow->id)}}'>
                    <img class='img-responsive' height='180' width='200' src='{{($follow)?Storage::url($follow->image): Storage::url($follow->image) }}'>
                </a>
                </th>
                <th scope="row" class='text-center' >
                <a href='{{route('show_seller', $follow->slug)}}' style='color:blue'>
                    {{($follow)?$follow->name:$follow->name}}
                </a>
                </th>
            </tr>
            @empty
            <tr>
                <td class='text-center'>
                    @lang('user.empty')
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {!! $followed->links() !!}

</div>
