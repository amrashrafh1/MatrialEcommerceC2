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
