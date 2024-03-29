@extends('products.layout')

@section('content')
{{-- Create Product --}}
    <div class="row">
        <div class="col-lg-12">
            
            <form action="{{ route('index')}}" method="GET">
                <div class="form-group">
                    <input type="search" name="query" class="form-control" placeholder="Search Phone or Model">
                </div>
                <button class="btn btn-primary">Search</button>
                
            </form>
           
                <div class="pull-right my-3">
                    <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                </div>
            
            
            <div class="pull-left my-3">
                <a class="btn btn-secondary" href="{{ route('products.index') }}"> Homepage </a>
            </div>
            <div class="pull-left my-3">
                <a class="btn btn-secondary" href="{{ route('category.index') }}"> Go to Category Table </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
{{-- Show Data Layout --}}
    <table class="table table-hover">
        <tr>
            <th>Product_ID</th>
            <th>Name</th>
            <th>Price</th>
            <th >Category</th>
            <th >Category</th>
            {{-- <th>Details</th>
            <th>Model No</th>
            <th>Android Version</th> --}}
            <th width="300px">Action</th>
        </tr>
        @foreach ($products as $product)
       
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            @foreach ($product->categories as $category)
                <td>{{ $category->title}}</td>

                
          
            @endforeach
            {{-- <td>{{ dd($product->name) }}</td>
            
            {{-- <td>{{ $product->details }}</td> --}}
            {{-- <td>{{ $product->category_products->category_id }}</td> --}}
            {{-- <td>{{ $product->category->android_version }}</td>  --}}
            
            <td class="text-center" colspan="2">
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {{ $products->links() }}


@endsection