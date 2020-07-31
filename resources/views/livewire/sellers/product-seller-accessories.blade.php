@php
$accessories_id = $this->product->accessories()->pluck('id');
@endphp
<div class="row">
    <div class="col-md-6">
        <div class="mb-2">
            <h4>
                @lang('admin.accessories')
            </h4>
        </div>
        <div class="card">
            <div class="cart-header">
                <!-- Search form -->
                <input type="text" id="myInput" wire:model='searchHas'  placeholder="Search for names..">
            </div>
            <div class="card-body">
                <table id="myTable">
                    <tr class="header">
                        <th>@lang('admin.remove')</th>
                        <th>@lang('admin.name')</th>
                        <th>@lang('admin.price')</th>
                    </tr>
                    @foreach($accessories as $product)
                    <tr>
                        <td>
                        <button class="btn btn-danger btn-sm" wire:click='remove_accessories("{{$product->slug}}")'>
                            <i class="fa fa-close"></i>
                        </button>
                    </td>
                    <td><a href="{{route('seller_frontend_products_edit',$product->slug)}}" class="text-primary">{{$product->name}}</a></td>
                        <td>{{$product->sale_price}}</td>
                    </tr>
                    @endforeach
                </table>
                {{ $accessories->links() }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-2">
            <h4>
                @lang('admin.accessories')
            </h4>
        </div>
        <div class="card">
            <div class="cart-header">
                <!-- Search form -->
                <input type="text" id="myInput" wire:model='search'  placeholder="Search for names..">
            </div>
            <div class="card-body">
                <table id="myTable">
                    <tr class="header">
                        <th>@lang('admin.add')</th>
                        <th>@lang('admin.name')</th>
                        <th>@lang('admin.price')</th>
                    </tr>
                    @foreach($products as $product)
                    <tr>
                        <td>
                        @if($accessories_id->contains($product->id))
                            <button class="btn btn-success btn-sm disabled bg-dark text-white" disabled wire:click='add_accessories("{{$product->slug}}")'>
                                <i class="fa fa-plus"></i>
                            </button>
                            @else
                            <button class="btn btn-success btn-sm" wire:click='add_accessories("{{$product->slug}}")'>
                                <i class="fa fa-plus"></i>
                            </button>
                        @endif
                        </td>
                        <td><a href="{{route('seller_frontend_products_edit',$product->slug)}}" class=" text-primary">{{$product->name}}</a></td>
                        <td>{{$product->sale_price}}</td>
                    </tr>
                    @endforeach
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>


<style>
    #myInput {
        background-image: url('/css/searchicon.png');
        /* Add a search icon to input */
        background-position: 10px 12px;
        /* Position the search icon */
        background-repeat: no-repeat;
        /* Do not repeat the icon image */
        width: 100%;
        /* Full-width */
        font-size: 16px;
        /* Increase font-size */
        padding: 12px 20px 12px 40px;
        /* Add some padding */
        border: 1px solid #ddd;
        /* Add a grey border */
        margin-bottom: 12px;
        /* Add some space below the input */
    }

    #myTable {
        border-collapse: collapse;
        /* Collapse borders */
        width: 100%;
        /* Full-width */
        border: 1px solid #ddd;
        /* Add a grey border */
        font-size: 18px;
        /* Increase font-size */
    }

    #myTable th,
    #myTable td {
        text-align: left;
        /* Left-align text */
        padding: 12px;
        /* Add padding */
    }

    #myTable tr {
        /* Add a bottom border to all table rows */
        border-bottom: 1px solid #ddd;
    }

    #myTable tr.header,
    #myTable tr:hover {
        /* Add a grey background color to the table header and on hover */
        background-color: #f1f1f1;
    }

</style>
