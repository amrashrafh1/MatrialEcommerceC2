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

@push('js')
<script>
     document.addEventListener('DOMContentLoaded', function () {
    //console.log('asdasd');
        window.livewire.on('compareAdded', function() {
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
