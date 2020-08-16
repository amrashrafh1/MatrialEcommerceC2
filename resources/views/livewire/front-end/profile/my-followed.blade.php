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
            <tr>
                <th scope="row" class='text-center'>
                <a href='{{route('show_seller', $follow->id)}}'>
                    <img class='img-responsive' src='{{($follow->seller_info)?Storage::url($follow->seller_info->image): Storage::url($follow->image) }}'>
                </a>
                </th>
                <th scope="row" class='text-center' >
                <a href='{{route('show_seller', $follow->id)}}' style='color:blue'>
                    {{($follow->seller_info)?$follow->seller_info->name:$follow->name}}
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
