@extends('admin.layout.app')

@section('content')



<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-2 mt-5">
            <div class="col-md-12">
               <a href="{{ route('admin#pizza') }}" class="text-decoration-none"> <div class="mb-4 text-dark"><i class="fas fa-arrow-left"></i> Back</div></a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Pizza Information</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane d-flex justify-content-center align-items-center" id="activity">

                        <div class="mt-2 pl-3 text-center">
                            <img class="img-thumbnail rounded-circle" src="{{ asset('uploads/'.$pizza->image) }}" style="width: 250px; height:250px;" alt="">
                        </div>

                        <div class="" style="margin-left: 100px;">
                        
                        <div class="mt-3">
                            <b>Name</b> : <span>{{ $pizza->pizza_name }}</span>
                        </div>

                        <div class="mt-3">
                            <b>Price</b> : <span>{{ $pizza->price }} Kyats</span>
                        </div>


                        <div class="mt-3">
                            <b>Publish Status</b> :
                           @if ($pizza->publish_status == 1)
                               YES
                           @else
                               NO
                           @endif
                        </div>

                        <div class="mt-3">
                            <b>Discount Price</b> : <span>{{ $pizza->discount_price }} Kyats</span>
                        </div>

                        <div class="mt-3">
                            <b>Category</b> : <span>{{ $pizza->category_id }} </span>
                        </div>

                        <div class="mt-3">
                            <b>Buy One Get One Status</b> :
                           @if ($pizza->buy_one_get_one_status == 1)
                               YES
                           @else
                               NO
                           @endif
                        </div>

                        <div class="mt-3">
                            <b>Waiting Time</b> : <span>{{ $pizza->waiting_time }} </span>
                        </div>

                        <div class="mt-3">
                            <b>Description</b> : <span>{{ $pizza->description }} </span>
                        </div>
                        </div>
                      
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>



@endsection