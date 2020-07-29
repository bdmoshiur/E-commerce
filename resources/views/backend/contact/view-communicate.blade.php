@extends('backend.layouts.master')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Communicate</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Communicate</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-md-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                    <h3>
                        Communicate List
                    </h3>
              </div><!-- /.card-header -->
              <div class="card-body ">
               <table id="example1" class="table table-bordered table-striped ">
                  <thead>
                  <tr>
                      <th>SL.</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Mobile No</th>
                    <th>Address</th>
                    <th>Message</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($allData as $key => $communicate)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $communicate->name }}</td>
                            <td>{{ $communicate->email }}</td>
                            <td>{{ $communicate->mobile_no }}</td>
                            <td>{{ $communicate->address }}</td>
                            <td>{{ $communicate->msg }}</td>
                            <td>
                            <a title="Delete" id="delete" class="btn btn-danger btn-sm" href="{{ route('contact.communicate.delete',$communicate->id) }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                   </tbody>
                </table>

              </div><!-- /.card-body -->
            </div>

          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
