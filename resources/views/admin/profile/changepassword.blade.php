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
                  <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                @if(Session::has('notmatcherror'))
                  <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                    {{ Session::get('notmatcherror') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                    
                @endif

                @if(Session::has('notsameerror'))
                  <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                    {{ Session::get('notsameerror') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                    
                @endif

                @if(Session::has('lengtherror'))
                  <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                    {{ Session::get('lengtherror') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                    
                @endif

                @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                    
                @endif
               
            
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{ route('admin#changepassword',Auth()->user()->id) }}" method="post">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-12 col-form-label">Old Password</label>
                          <div class="col-sm-12">
                            <input type="password" class="form-control"  name="oldpassword"  placeholder="New Password">
                            @if ($errors->has('oldpassword'))
                            <p class="text-danger">{{ $errors->first('oldpassword') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-12 col-form-label">New Password</label>
                          <div class="col-sm-12">
                            <input type="password" class="form-control" name="newpassword"  placeholder="New Password">
                            @if ($errors->has('newpassword'))
                            <p class="text-danger">{{ $errors->first('newpassword') }}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-12 col-form-label">Confirm Password</label>
                          <div class="col-sm-12">
                            <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
                            @if ($errors->has('confirmpassword'))
                            <p class="text-danger">{{ $errors->first('confirmpassword') }}</p>
                            @endif
                          </div>
                        </div>

                        


                        <div class="form-group row float-right">
                          <div class="col-sm-12">
                            <button type="submit" class="btn bg-dark text-white">Change Password</button>
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
    </section>
  </div>

                            
@endsection