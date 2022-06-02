@extends('user.layouts.style')

@section('content')

<div class="row mt-5 d-flex justify-content-center">
    <div class="col-12 text-center text-success mb-5">
        <h1>$ Order Page $</h1>
    </div>
    @if(Session::has('totalTime'))
        <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
        Order Success! Please wait {{ Session::get('totalTime') }} Minutes...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
    @endif
<div class="col-4 ">
    <img src="{{ asset('uploads/'.$pizza->image) }}" width="100%">            <br>
   
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
    <span>{{ $pizza->price - $pizza->discount_price }} </span> Kyats <hr/>


    <h5>Waiting Time</h5>
    <span>{{ $pizza->waiting_time }} Minutes</span> <hr/>

   <form action="{{ route('user#placeOrder') }}" method="post">
       @csrf
   <h5>Pizza Count</h5>
    <input type="number" name="pizzaCount" id="" class="form-control" placeholder="Number of pizza you want"> <hr>
    @if($errors->has('pizzaCount'))
        <p class="text-danger">{{ $errors->first('pizzaCount') }}</p>

    @endif
    <h5>Payment Type</h5>
    <div class="form-check form-check-inline">
        <input type="radio" class="form-check-input" name="paymentType" id="inlineRadio1" value="1">
        <label for="inlineRadio1" class="form-check-label">Credit</label>
    </div>
    <div class="form-check form-check-inline">
        <input type="radio" class="form-check-input" name="paymentType" id="inlineRadio2" value="2">
        <label for="inlineRadio2" class="form-check-label">Cash</label>
    </div><br>
    @if($errors->has('paymentType'))
        <p class="text-danger">{{ $errors->first('paymentType') }}</p>

    @endif

    <button class="btn btn-primary float-end mt-5 col-12" type="submit"><i class="fas fa-shopping-cart"></i> Place Order</button>
   </form>




</div>
</div>

@endsection