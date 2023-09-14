@extends('admin.layout.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Detail Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Detail Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form role="form" action="{{ route('admin.product.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" value="{{ $product->name }}"
                                            class="form-control" id="name" placeholder="Enter name">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input name="slug" type="text" value="{{ $product->slug }}"
                                            class="form-control" id="slug" placeholder="a-b-c">
                                        @error('slug')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input name="price" type="text" value="{{ $product->price }}"
                                            class="form-control" id="price" placeholder="Enter Price">
                                        @error('price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="discount_price">Discount_Price</label>
                                        <input name="discount_price" type="text" value="{{ $product->discount_price }}"
                                            class="form-control" id="discount_price" placeholder="Enter discount_price">
                                        {{-- loi tu truyen qa ben day --}}
                                        @error('discount_price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="short_description">Short Description</label>
                                        <textarea name="short_description" id="short_description" cols="30" rows="10"
                                            placeholder="Enter short_description" value="{{ $product->short_description }}" class="form-control"></textarea>
                                        @error('short_description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="qty">Quantity</label>
                                        <input name="qty" type="number" value="{{ $product->qty }}"
                                            class="form-control" id="qty" placeholder="Enter Quantity">
                                        {{-- loi tu truyen qa ben day --}}
                                        @error('qty')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="shipping">Shipping</label>
                                        <input name="shipping" type="text" value="{{ $product->shipping }}"
                                            class="form-control" id="shipping" placeholder="Enter shipping">
                                        {{-- loi tu truyen qa ben day --}}
                                        @error('shipping')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="shipping">Shipping</label>
                                        <input name="shipping" type="text" value="{{ old('shipping') }}"
                                            class="form-control" id="shipping" placeholder="Enter shipping">
                                        {{-- loi tu truyen qa ben day --}}
                                        @error('shipping')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input name="weight" type="text" value="{{ $product->weight }}"
                                            class="form-control" id="weight" placeholder="Enter weight">
                                        {{-- loi tu truyen qa ben day --}}
                                        @error('weight')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter description"
                                            value="{{ old('description') }}" class="form-control">{{ $product->description }}</textarea>

                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="information">Information</label>
                                        <textarea name="information" id="information" cols="30" rows="10" placeholder="information"
                                            value="{{ old('information') }}" class="form-control">{{ $product->information }}</textarea>
                                        @error('information')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input name="image" type="file" value="{{ $product->image }}"
                                            class="form-control" id="image">
                                        {{-- loi tu truyen qa ben day --}}
                                        @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="custom-select" name="status">
                                            <option value="">---Please Select---</option>
                                            <option {{ $product->status === '1' ? 'selected' : '' }} value="1">Show
                                            </option>
                                            <option {{ $product->status === '0' ? 'selected' : '' }} value="0">Hide
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Product_Category</label>
                                        <select class="custom-select" name="product_categories_id">
                                            @foreach ($productCategories as $productCategory)
                                                <option value="{{ $productCategory->id }}">{{ $productCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_categories_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/.col (left) -->

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js-custom')
    <script>
        ClassicEditor
            .create(document.querySelector('#short_description'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#information'))
            .catch(error => {
                console.error(error);
            });

        $(document).ready(function() {
            $('#name').on('keyup', function() {
                let name = $('#name').val();
                console.log(name);
                $.ajax({
                    method: "POST", //method of form
                    url: "{{ route('admin.product.create.slug') }}", //action of form
                    data: {
                        'name': name,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#slug').val(response.slug);
                    }
                });
            });
        });
    </script>
@endsection
