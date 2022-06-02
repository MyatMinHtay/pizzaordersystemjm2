@extends('admin.layout.app')

@section('content')


<div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
           

            @if(Session::has('updatesuccess'))
              <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ Session::get('updatesuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                
            @endif
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-conent-between">

          <div class="text-success float-start  mt-2 h4 mx-auto">
              Total Message - {{ $contact->total() }}
            </div>

            <div class="float-end">
              <form action="{{ route('admin#contactSearch') }}" method="get">
                @csrf
                <div class="input-group input-group-sm mt-2" style="width: 150px;">
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

          
           
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>User ID</th>
                  
                </tr>
              </thead>
              <tbody>

              @if ($status == 0)
              <tr>
                  <td colspan="4">
                      <small class="text-muted">There is no data.</small>
                  </td>
              </tr>
                @else
                @foreach($contact as $item)
                <tr>
                  <td>{{ $item-> contact_id }}</td>
                  <td>{{ $item -> name }}</td>
                  <td>{{ $item->email }}</td>
                  <td>
                  {{ $item -> message }}
                  </td>
                  <td>
                      {{$item->user_id}}
                  </td>
               
                </tr>

                @endforeach
                @endif
              </tbody>
            </table>

            <div class="mt-4 ms-3">{{ $contact->links() }}</div>
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