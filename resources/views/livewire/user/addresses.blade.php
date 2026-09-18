<div class="container py-5">


<h2>
My Addresses
</h2>


@if(session()->has('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>

@endif



<div class="card p-4 mt-4">


<h5>
Add New Address
</h5>


<form wire:submit="save">


<input class="form-control mb-2"
placeholder="Name"
wire:model="name">


<input class="form-control mb-2"
placeholder="Phone"
wire:model="phone">


<textarea class="form-control mb-2"
placeholder="Address"
wire:model="address"></textarea>


<input class="form-control mb-2"
placeholder="City"
wire:model="city">


<input class="form-control mb-2"
placeholder="State"
wire:model="state">


<input class="form-control mb-2"
placeholder="Postal Code"
wire:model="postal_code">



<button class="btn btn-dark">
Save Address
</button>


</form>


</div>




<h4 class="mt-5">
Saved Addresses
</h4>



@foreach($addresses as $item)


<div class="card p-3 mt-3">


<strong>
{{ $item->name }}
</strong>


<p>
{{ $item->phone }}
</p>


<p>
{{ $item->address }},
{{ $item->city }}
</p>


<button 
wire:click="delete({{ $item->id }})"
class="btn btn-danger btn-sm">

Delete

</button>


</div>


@endforeach



</div>