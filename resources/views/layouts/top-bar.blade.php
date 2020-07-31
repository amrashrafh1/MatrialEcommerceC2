<div class="top-bar top-bar-v1">
    <div class="col-full">
        <ul id="menu-top-bar-left" class="nav justify-content-center">
            <li class="menu-item animate-dropdown">
                <a title="TechMarket eCommerce - Always free delivery" href="contact-v1.html">TechMarket eCommerce &#8211; Always free delivery</a>
            </li>
            <li class="menu-item animate-dropdown">
                <a title="Quality Guarantee of products" href="shop.html">Quality Guarantee of products</a>
            </li>
            <li class="menu-item animate-dropdown">
                <a title="Fast returnings program" href="track-your-order.html">Fast returnings program</a>
            </li>
            <li class="menu-item animate-dropdown">
                <a href="{{route('chat')}}" class='notification'>
                    <i class="fa fa-envelope fa-2x" style='color:#3265B0'></i>
                    <span class="badge">@auth {{auth()->user()->unReadedMessages->count()}}@else 0 @endif</span>
                </a>
            </li>
        </ul>
        <!-- .nav -->
    </div>
    <!-- .col-full -->
</div>


<style>

.notification{
    position: relative;
}

.notification .badge {
  position     : absolute;
  top          : 1px;
  right        : -10px;
  padding      : 5px;
  border-radius: 50%;
  font-size    : 11px;
  background   : red;
  color        : white;
}
</style>
