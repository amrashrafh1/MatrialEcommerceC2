<ul class="header-compare nav navbar-nav">
    <li class="nav-item">
        <a href="{{route('show_compare')}}" class="nav-link">
            <i class="tm tm-compare"></i>
            @if(session()->get('compare') !== null)
            <span id="top-cart-compare-count" class="value">{{count(session()->get('compare'))}}</span>
            @else
            <span id="top-cart-compare-count" class="value">0</span>
            @endif
        </a>
    </li>
</ul>
