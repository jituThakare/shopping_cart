@extends('layouts.admin')
@section('title', 'Addproduct')

@section('content')
<section id="products" style="background-color: white; max-height:100%; ">
    <h2 class="text-center py-3 ">Add products</h2>

    <div class="container-md bg-success p-5" style="max-width: 600px;">
        <form  method="post" enctype="multipart/form-data">
            @csrf
        
            @if (session('status'))  
        
            <div class="alert text-dark alert-warning" role="alert">
             {{ session('status') }}
            </div> 
            
            @endif
            
            <div class="form-group">
                <label class="font-weight-bold" for="productName">Product name</label>
                <input type="text" name="product_name" class="form-control" placeholder="product name" id="productName" value="{{ old('product_name') }}">
                @error('product_name')
                    <div class="alert alert-danger p-0 my-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="desc">Product description</label>
                <textarea class="form-control" name="product_desc" id="desc" rows="3">{{ old('product_desc') }}"</textarea>
                @error('product_desc')
                <div class="alert alert-danger p-0 my-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlSelect1">Product category</label>
                <select class="form-control" id="exampleFormControlSelect1" name="cat_name">
                    <option value="">--- select category ---</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_name }} ">  {{ $category->category_name }}   </option>
                    @endforeach                 
                    
                </select>
                @error('cat_name')
                <div class="alert alert-danger p-0 my-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlTextarea1">Product price</label>
                <input type="text" class="form-control" name="price" placeholder="product price" id="exampleFormControlInput1" placeholder="">
                @error('price')
                <div class="alert alert-danger p-0 my-1">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="imgFile">Product image</label>
                <input type="file" class="form-control-file" name="image" id="productimage">
                <small>only jpg/png are allowed</small>
                @error('image')
                <div class="alert alert-danger p-0 my-1 ">{{ $message }}</div>
               @enderror
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>
@endsection