@extends('admin.layout.app')

@section('content')


<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
            
    <div class="row mt-4">
      <div class="col-10 offset-1 mt-2">
          <h3 class="mt-3">{{ $pizza[0]->category_name }}</h3>
        <div class="card">
          <div class="card-header">
            

          <div class="bg-muted text-center text-success"><h3 class="">Total  - {{ $pizza->total() }}</h3></div>

           
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">

          
           
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Pizza Name</th>
                  <th>Price</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                
                @foreach($pizza as $item)
                <tr>
                  <td>{{ $item->category_id }}</td>
                  <td>
                      <img src="{{ asset('uploads/'.$item->image) }}" width="150px" height="100px" >
                  </td>
                  <td>{{ $item->pizza_name }}</td>
                  <td>
                    {{ $item->price }}
                  </td>
                  
                </tr>

                @endforeach
                
              </tbody>
            </table>

            <div class="mt-4 ms-3">{{ $pizza ->links() }}</div>
          </div>
          <!-- /.card-body -->
        </div>

        <div class="card-footer">
            <a href="{{ route('admin#category') }}" class="text-decoration-none">
                <button class="btn btn-dark text-white">Back</button>
            </a>
        </div>
        <!-- /.card -->
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

@endsection