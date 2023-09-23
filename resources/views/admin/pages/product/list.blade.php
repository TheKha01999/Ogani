@extends('admin.layout.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product List</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mr-3">Product List</h3>
                                <a href="{{ route('admin.product.create') }}"
                                    class="card-title btn btn-primary mr-3">Add</a>
                            </div>
                            @if (session('message'))
                                <div class="col-sm-12 alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Avatar</th>
                                            <th>Short_Desciption</th>
                                            <th>Product_Category_Name</th>
                                            <th>Created_at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>
                                                    @php
                                                        $imagesLink = is_null($product->image) || !file_exists('images/' . $product->image) ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg' : asset('images/' . $product->image);
                                                    @endphp
                                                    <img width="50px" src="{{ $imagesLink }}" alt="">
                                                </td>
                                                <td>{!! $product->short_description !!}</td>
                                                {{-- <td>{{ $product->product_category_name }}</td> --}}
                                                <td>{{ $product->product_category->name }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('admin.product.destroy', ['product' => $product->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button onclick="return confirm('Are u surre !')" type="submit"
                                                            name="submit" class="btn btn-danger">Delete</button>

                                                    </form>
                                                    <a href="{{ route('admin.product.show', ['product' => $product->id]) }}"
                                                        class="btn btn-primary">Detail</a>
                                                    @if (!is_null($product->deleted_at))
                                                        <a href="{{ route('admin.product.restore', ['product' => $product->id]) }}"
                                                            class="btn btn-success">Restore</a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No data</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $products->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
