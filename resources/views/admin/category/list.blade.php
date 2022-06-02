@extends('admin.layout.app')

@section('content')


<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
            @if(Session::has('categorySuccess'))
              <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ Session::get('categorySuccess') }}
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
                <a href="{{ route('admin#addCategory') }}" class="text-decoration-none">
                <button class="btn btn-sm btn-outline-dark mt-2">Add Category</button>
                </a>

                
              </h3>
            </div>

          <div class="text-success  mt-2 h4 mx-auto">
            Total Category - {{ $category->total() }}
          </div>

          <div>
            <a href="{{ route('admin#categoryDownload') }}" class="text-decoration-none">
            <button class="btn btn-sm btn-success mt-2 me-3">Download CSV</button>
            </a>
          </div>

            <div class="float-end">
              <form action="{{ route('admin#searchCategory') }}" method="get">
                @csrf
                <div class="input-group input-group-sm mt-2" style="width: 200px;">
                  <input type="text" name="searchData" class="form-control float-right" placeholder="Search">

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

          <!-- <div class="bg-muted text-center text-success"><h3 class="">Total Category - {{ $category->total() }}</h3></div> -->
           
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Product Count</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                
                @foreach($category as $item)
                <tr>
                  <td>{{ $item->category_id }}</td>
                  <td>{{ $item->category_name }}</td>
                  <td>
                    @if ($item->count == 0)
                      <a href="" class="text-decoration-none">0</a>
                    @else
                     
                    <a href="{{ route('admin#categoryItem' , $item->category_id) }}" class="text-decoration-none">{{ $item->count }}</a>

                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin#editCategory',$item->category_id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                   <a href="{{ route('admin#deleteCategory',$item->category_id) }}"> <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                  </td>
                </tr>

                @endforeach
                
              </tbody>
            </table>

            <div class="mt-4 ms-3">{{ $category->links() }}</div>
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

@endsection