<ul class="header-wishlist nav navbar-nav">
    <li class="nav-item">
        <a href="{{ url('/wishlists') }}" class="nav-link">
            <i class="tm tm-favorites"></i>
            <span id="top-cart-wishlist-count" class="value">
                @guest
                0
                @else
                {{ count(auth()->user()->wishlists) }}
                @endauth</span>
        </a>
    </li>
</ul>
@push('js')
<script>
     document.addEventListener('DOMContentLoaded', function () {
    //console.log('asdasd');
        window.livewire.on('wishlistAdded', function() {
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '{{trans("admin.added")}}',
            showConfirmButton: true,
            timer: 1500
            });
        })
    })
    </script>
@endpush
