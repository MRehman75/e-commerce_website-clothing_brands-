<div>
   <a href="{{ route('cart') }}" class="icon-link position-relative">
    <i class="fas fa-shopping-bag"></i>
    @if($count > 0)
        <span class="bag-count cart-count" id="cartCountBadge">{{ $count }}</span>
    @else
        <span class="bag-count cart-count" id="cartCountBadge" style="display:none;">0</span>
    @endif
</a>
</div>
