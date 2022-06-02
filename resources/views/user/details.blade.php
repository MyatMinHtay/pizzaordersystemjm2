@extends('user.layouts.style')

@section('content')

<div class="row mt-5 d-flex justify-content-center">

<div class="col-4 ">
    <img src="{{ asset('uploads/'.$pizza->image) }}" width="100%">            <br>
   <a href="{{ route('user#order') }}" class="text-decoration-none">
   <button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Order</button>
   </a>
    <a href="{{ route('user#index') }}">
        <button class="btn bg-dark text-white" style="margin-top: 20px;">
            <i class="fas fa-backspace"></i> Back
        </button>
    </a>
</div>
<div class="col-6">
    
    <h5>Name</h5>
    <span>{{ $pizza->pizza_name }}</span> <hr/>

    <h5>Price</h5>
    <span>{{ $pizza->price }} Kyats</span> <hr/>

    <h5>Discount Price</h5>
    <span>{{ $pizza->discount_price }} Kyats</span> <hr/>

    <h5>Buy One Get One</h5>
    <span>
    @if ($pizza -> buy_one_get_one_status == 0)
        Not Have
    @else
        Have
    @endif

    </span> <hr/>

    <h5>Waiting Time</h5>
    <span>{{ $pizza->waiting_time }} Minutes</span> <hr/>

    <h5>Description</h5>
    <span>{{ $pizza->description }}</span> <hr/>

    <br>

    <div class="text-right d-flex justify-content-end">
    <h5 class="text-success">Total Price - </h5>
    <h5 class="text-right">{{ $pizza->price - $pizza->discount_price }} Kyats</h5> <hr/>
    </div>
</div>
</div>

@endsection