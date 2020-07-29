@extends('backend.layouts.master')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
                        Product Details Info
                            <a class="btn btn-success float-right btn-sm"  href="{{ route('products.view') }}"><i class="fa fa-list"></i>Product List</a>
                    </h3>
              </div><!-- /.card-header -->
              <div class="card-body ">
                <table class="table table-bordered table-striped table-sm">
                    <tbody>
                        <tr>
                            <td width="50%">Category</td>
                            <td width="50%">{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <td width="50%">Brand</td>
                            <td width="50%">{{ $product->brand->name }}</td>
                        </tr>
                        <tr>
                            <td width="50%">Product Name</td>
                            <td width="50%">{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td width="50%">Price</td>
                            <td width="50%">{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <td width="50%">Short Description</td>
                            <td width="50%">{{ $product->short_desc }}</td>
                        </tr>
                        <tr>
                            <td width="50%">Long Description</td>
                            <td width="50%">{{ $product->long_desc }}</td>
                        </tr>
                           <tr>
                            <td width="50%">Colors</td>
                            <td width="50%">
                                @php
                                $colors = App\Model\ProductColor::where('product_id',$product->id)->get();
                                 @endphp
                                @foreach ($colors as $c)
                                    {{ $c->color->name }},
                                @endforeach
                            </td>
                        </tr>
                         <tr>
                            <td width="50%">Sizes</td>
                            <td width="50%">
                                @php
                                $sizes = App\Model\ProductSize::where('product_id',$product->id)->get();
                                 @endphp
                                @foreach ($sizes as $s)
                                    {{ $s->size->name }},
                                @endforeach
                            </td>
                        </tr>
                         <tr>
                            <td width="50%">Image</td>
                            <td width="50%">
                                  <img id="showImage" src="{{ (!empty(@$product->image)) ? url('upload/product_images/'.$product->image):url('upload/no_image.png')}}" style="width: 50px;height: 55px;">
                            </td>
                        </tr>
                         <tr>
                            <td width="50%">Product Sub Image</td>
                            <td width="50%">
                                @php
                                $sub_images = App\Model\ProductSubImage::where('product_id',$product->id)->get();
                                 @endphp
                                @foreach ($sub_images as $img)
                                <img id="showImage" src="{{ url('upload/product_images/product_sub_images/'.$img->sub_image)}}" style="width: 50px;height: 55px;">
                                @endforeach
                            </td>
                        </tr>
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
