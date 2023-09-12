@extends('admin.layout.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Categories</li>
                        </ol>
                    </div>
                    {{-- session flash f5 trangg web tu mat, thong bao them thanh cong categoris list --}}
                    @if (session('message'))
                        <div class="col-sm-12 alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex ">
                                <h3 class="card-title mr-3">Product Categories</h3>
                                <a href="{{ route('admin.product_categories.add') }}"
                                    class="card-title btn btn-primary mr-3">Add</a>
                                <form role="form" action="" method="get">
                                    <input type="text" placeholder="Search..." class="mr-3" name='keyword'
                                        value="{{ $keyword }}">
                                    <select name="sortBy">
                                        <option selected>---select option---</option>
                                        <option {{ $sortBy === 'oldest' ? 'selected' : '' }} value="oldest">Oldest</option>
                                        <option {{ $sortBy === 'latest' ? 'selected' : '' }} value="latest">Latest</option>
                                    </select>
                                    <button class=" btn btn-primary" type="submit">Search</button>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Created_at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($productCategories as $productCategory)
                                            <tr>
                                                <td>{{ $id++ }}</td>
                                                <td>{{ $productCategory->name }}</td>
                                                <td>
                                                    <div
                                                        class="{{ $productCategory->status === 1 ? 'btn btn-success' : 'btn btn-danger' }}">
                                                        {{ $productCategory->status === 1 ? 'show' : 'hide' }}
                                                    </div>
                                                </td>
                                                <td>{{ $productCategory->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('admin.product_categories.detail', ['id' => $productCategory->id]) }}"
                                                        class="btn btn-primary">Detail</a>
                                                    <a onclick="return confirm('Are u sure !')"
                                                        href="{{ route('admin.product_categories.destroy', ['id' => $productCategory->id]) }}"
                                                        class="btn btn-danger">Delete</a>
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
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    @for ($x = 1; $x <= $totalPage; $x++)
                                        <li class="page-item {{ $x == $currentPage ? 'active' : '' }}"><a
                                                class="page-link "
                                                href="?page={{ $x }}">{{ $x }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
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
