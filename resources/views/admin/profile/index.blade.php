@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
      
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">My Profile Info</legend>
                </div>
                <div class="card-body">
                @if(Session::has('updatesuccess'))
                  <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    {{ Session::get('updatesuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                    
                @endif
                @if(Session::has('passworderrors'))
                  <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    {{ Session::get('passworderrors') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                    
                @endif

            
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{ route('admin#updateProfile',$user->id) }}" method="post">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Name</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" value="{{ old('name',$user->name) }}" id="inputName" placeholder="Name">
                            @if ($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
                          <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" value="{{ old('email',$user->email) }}" id="inputEmail" placeholder="Email">
                            @if ($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Phone</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="phone" value="{{ old('phone',$user->phone)  }}" id="inputName" placeholder="Phone">
                            @if ($errors->has('phone'))
                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Address</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="address" value="{{ old('address',$user->address)  }}" id="inputName" placeholder="Address">
                            @if ($errors->has('address'))
                            <p class="text-danger">{{ $errors->first('address') }}</p>
                            @endif
                          </div>
                        </div>
                        
                       

                        <div class="form-group row float-left">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Update</button>
                          </div>
                        </div>
                      </form>
                     
                    </div>
                   
                  </div>

                  <div class="float-right">
                          <div class=" col-sm-12">
                            <a href="{{ route('admin#changepasswordpage') }}" class="text-decoration-none">Change Password</a>
                            
                            


                            
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