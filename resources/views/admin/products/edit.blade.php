@extends('layouts.admin')

@section('title')
    Admin | Edit Produk
@endsection

@section('content')
<form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div>
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}">
        @error('name')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="image">Gambar</label>
        <input type="file" name="image" id="image">
        @error('image')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="price">Harga</label>
        <input type="number" name="price" id="price" min="0" value="{{ $product->price }}">
        @error('price')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="stock">Stok</label>
        <input type="number" name="stock" id="stock" min="0" value="{{ $product->stock }}">
        @error('stock')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10">{{ $product->description }}</textarea>
        @error('description')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <input type="submit" value="Edit">
</form>
@endsection