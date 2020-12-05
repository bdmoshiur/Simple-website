
@extends('backend.layouts.master')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Vission</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vission</li>
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
                        Vission List
                        @if ($countVission< 1)
                        <a class="btn btn-success float-right btn-sm"  href="{{ route('vissions.add') }}"><i class="fa fa-plus-circle"></i>Add Vission</a>
                        @endif
                    </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($allData as $key => $vission)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <img src="{{ (!empty($vission->image)) ? url('upload/vission_images/'.$vission->image):url('upload/no_image.png')}}" width="120px" height="130xp">
                        </td>
                        <td>{{ $vission->title }}</td>
                        <td>
                            <a title="Edit" class="btn btn-primary btn-sm" href="{{ route('vissions.edit',$vission->id) }}"><i class="fa fa-edit"></i></a>
                            <a title="Delete" id="delete" class="btn btn-danger btn-sm" href="{{ route('vissions.delete',$vission->id) }}"><i class="fa fa-trash"></i></a>
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
