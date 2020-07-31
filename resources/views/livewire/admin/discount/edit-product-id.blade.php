<div class="form-group">
    <div>
        <input type='text' wire:model='search' value='{{$this->search}}' class='form-control'
            placeholder="@lang('admin.search_for_product')">
    </div>
    <div class="col-md-9">
        <ul class='list-group'>
            @forelse($products as $index => $product)
            <li class='list-group-item' style='padding:5px;'>
                <div class='form-check'>

                    <input type='radio' class='form-check-radio' @if($this->productType === 'product_id')
                    name='product_id' id='product_id{{$index}}'
                    @else name='product_y' id='product_y{{$index}}'
                    @endif value='{{$product->id}}'
                    @if($product->id === $this->product_id)
                    checked="checked"
                    @endif
                    />
                    <label class='form-check-label' @if($this->productType === 'product_id')
                        for='product_id{{$index}}'
                        @else for='product_y{{$index}}'
                        @endif >
                        {{$product->name}}
                    </label>
                </div>
            </li>
            @empty
            Empty Value
            @endforelse
        </ul>

    </div>
    {!! $products->links() !!}
</div>
<br>
