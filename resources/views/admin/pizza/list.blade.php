@extends('admin.layout.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">


<!-- Main content -->
<section class="content">
  <div class="container-fluid">
            @if(Session::has('createPizza'))
              <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ Session::get('createPizza') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                
            @endif

            @if(Session::has('deleteSuccess'))
              <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ Session::get('deleteSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                
            @endif

            @if(Session::has('updatesuccess'))
              <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ Session::get('updatesuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                
            @endif
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-conent-center">
            <div class="mx-auto">
              <h3 class="card-title">
                <a href="{{ route('admin#createpizza') }}" class="text-decoration-none">
                  <button class="btn bg-dark text-white mt-2"><i class="fas fa-plus"></i></button>
                </a>
              </h3>
            </div>

            <div class="text-success  mt-2 h4 mx-auto">
              Total Pizza - {{ $pizza->total() }}
            </div>

            <div>
              <a href="{{ route('admin#pizzaDownload') }}" class="text-decoration-none">
              <button class="btn btn-sm btn-success mt-2 me-3">Download CSV</button>
              </a>
          </div>
            
            <div class="float-end">
              <form action="{{ route('admin#searchPizza') }}" method="get">
                <div class="input-group input-group-sm mt-2" style="width: 200px;">
                
                    @csrf
                   
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                
                </div>
              </form>
            </div>

            
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Pizza Name</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Publish Status</th>
                  <th>Buy 1 Get 1 Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

            
               @if ($status == 0)
                  <tr>
                    <td colspan="7" class="text-muted">
                      There is no pizza data
                    </td>
                  </tr>
               @else
               @foreach($pizza as $item)
                <tr>
                  <td>{{ $item->pizza_id }}</td>
                  <td>{{ $item->pizza_name }}</td>
                  <td>
                    <img src="{{ asset('uploads/'.$item->image) }}" class="img-thumbnail" width="100px">
                  </td>
                  <td>{{ $item->price }} kyats</td>
                  <td>
                    @if( $item->publish_status == 1 )
                      Publish
                    @elseif( $item->publish_status == 0)
                      Unpublish
                    @endif
                  </td>
                  <td>
                  @if( $item->buy_one_get_one_status == 1 )
                      Yes
                    @elseif( $item->buy_one_get_one_status == 0)
                      No
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin#editpizza',$item->pizza_id) }}" class="text-decoration-none">
                    <button class="btn btn-sm btn-dark text-white"><i class="fas fa-edit"></i></button>
                    </a>
                    <a href="{{ route('admin#deletePizza',$item->pizza_id) }}" class="text-decoration-none">
                    <button class="btn btn-sm btn-danger text-white"><i class="fas fa-trash-alt"></i></button>
                    </a>
                    <a href="{{ route('admin#pizzainfo',$item->pizza_id) }}" class="text-decoration-none">
                    <button class="btn btn-sm btn-primary text-white"><i class="fas fa-eye"></i></button>
                    </a>
                  </td>
                </tr>

                @endforeach
               @endif
               
                 
              </tbody>
            </table>
            <div>
              {{ $pizza->links() }}
            </div>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection