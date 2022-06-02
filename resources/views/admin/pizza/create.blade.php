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
                  <legend class="text-center">Add Pizza</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" method="post" action="{{ route('admin#insertPizza') }}" enctype="multipart/form-data">
                        @csrf  
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Name</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Enter Pizza Name" name="name">
                            @if($errors->has('name'))
                              <p class="text-danger">{{ $errors->first('name') }}</p>

                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Image</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control" placeholder="Choose Image" name="image">
                            @if($errors->has('image'))
                              <p class="text-danger">{{ $errors->first('image') }}</p>

                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Price</label>
                          <div class="col-sm-8">
                            <input type="number" class="form-control" placeholder="Enter Pizza Price" name="price">
                            @if($errors->has('price'))
                              <p class="text-danger">{{ $errors->first('price') }}</p>

                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Public Status</label>
                          <div class="col-sm-8">
                            <select name="publish" id="" class="form-control">
                                <option value="" selected disabled>Choose Status</option>
                                <option value="1">Publish</option>
                                <option value="0">Unpublish</option>
                                
                            </select>
                            @if($errors->has('publish'))
                              <p class="text-danger">{{ $errors->first('publish') }}</p>

                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Category</label>
                          <div class="col-sm-8">
                          <select name="category" id="" class="form-control">
                            <option value="" selected disabled>Choose Category</option>
                            @foreach($category as $item)
                                <option value="{{ $item->category_id }}">{{ $item->category_name }}</option>
                             @endforeach   
                                
                            </select>
                            @if($errors->has('category'))
                              <p class="text-danger">{{ $errors->first('category') }}</p>

                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Discount</label>
                          <div class="col-sm-8">
                            <input type="number" class="form-control" placeholder="Write Discount" name="discount">
                            @if($errors->has('discount'))
                              <p class="text-danger">{{ $errors->first('discount') }}</p>

                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Bye 1 Get 1</label>
                          <div class="col-sm-8 mt-2">
                            <input type="radio" name="buyonegetone" id="yes" class="form-input-ckeck me-1" value="1"><label for="yes">Yes</label>
                            <input type="radio" name="buyonegetone" id="no" class="form-input-check me-1" value="0"> <label for="no">No</label>
                            @if($errors->has('buyonegetone'))
                              <p class="text-danger">{{ $errors->first('buyonegetone') }}</p>

                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Waiting Time</label>
                          <div class="col-sm-8">
                            <input type="number" class="form-control" placeholder="Write Waiting Time" name="waitingtime">
                            @if($errors->has('waitingtime'))
                              <p class="text-danger">{{ $errors->first('waitingtime') }}</p>

                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Description</label>
                          <div class="col-sm-8">
                           <textarea name="description" id="" rows="3" placeholder="write descripton"></textarea>
                            @if($errors->has('description'))
                              <p class="text-danger">{{ $errors->first('description') }}</p>

                            @endif
                          </div>
                        </div>


                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Add</button>
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