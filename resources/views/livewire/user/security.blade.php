<div class="container py-5">


<h2>
Security
</h2>


@if(session()->has('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif



<div class="card p-4 mt-4">


<form wire:submit="updatePassword">


<div class="mb-3">

<label>
Current Password
</label>

<input 
type="password"
class="form-control"
wire:model="current_password">


@error('current_password')
<span class="text-danger">
{{ $message }}
</span>
@enderror


</div>




<div class="mb-3">

<label>
New Password
</label>

<input 
type="password"
class="form-control"
wire:model="password">


@error('password')
<span class="text-danger">
{{ $message }}
</span>
@enderror


</div>





<div class="mb-3">

<label>
Confirm New Password
</label>

<input 
type="password"
class="form-control"
wire:model="password_confirmation">


</div>



<button class="btn btn-dark">

Change Password

</button>


</form>


</div>


</div>