@extends('admin.layout.app')

@section('content')



<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
            @if(Session::has('notupdateCategory'))
              <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                {{ Session::get('notupdateCategory') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                
                @endif
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
               <a href="{{ route('admin#category') }}" class="text-decoration-none"> <div class="mb-4 text-dark"><i class="fas fa-arrow-left"></i> Back</div></a>
              <div class="card">
             
                <div class="card-header p-2">
                  <legend class="text-center">Edit Category</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="POST" action="{{ route('admin#updateCategory') }}">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label">Category Name</label>
                          <div class="col-sm-9">
                              <input type="hidden" name="id" value="{{ $category->category_id }}">
                            <input type="text" class="form-control" placeholder="Name" value="{{ old('name',$category->category_name) }}" name="name">
                            @if($errors->has('name'))
                              <p class="text-danger">{{ $errors->first('name') }}</p>

                            @endif
                          </div>
                        </div>


                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Update</button>
                          </div>
                        </div>
                      </form>
                      
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