@extends('layouts.app')

@section('title', 'Products')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Products</h1>
                <div class="section-header-button">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Add New</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Products</h2>
                <p class="section-lead">
                    You can manage all products, such as editing, deleting and more.
                </p>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Product</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div> --}}
                                <div class="float-left">
                                    {{-- <a href="{{ route('users.index') }}"></a> --}}
                                    <form method="GET" action="{{ route('products.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Name</th>
                                            {{-- <th>Description</th> --}}
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Category</th>
                                            <th>Photo</th>
                                            {{-- <th>Created At</th> --}}
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                {{-- <td>{{ $product->description }}</td> --}}
                                                <td>{{ $product->purchase_price }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>{{ $product->category }}</td>
                                                <td>
                                                    @if ($product->image && file_exists('storage/products/' . $product->image))
                                                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                                                        width="50">
                                                    @else
                                                    <span class="badge badge-danger">No Image</span>
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $product->created_at }}</td> --}}
                                                <td>
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-sm btn-info btn-icon"><i class="fa fa-edit"></i> Edit</a>
                                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure?')"><i class="fa fa-times"></i> Delete</button>
                                                    </form>
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                        class="btn btn-sm btn-primary btn-icon"><i class="fa fa-eye"></i> Show</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $products->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
