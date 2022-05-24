@extends('layouts.admin')

@section('title')
    Admin | Tambah Produk
@endsection

@section('content')
<form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Nama</label>
        <input type="text" name="name" id="name">
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
        <input type="number" name="price" id="price" min="0">
        @error('price')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="stock">Stok</label>
        <input type="number" name="stock" id="stock" min="0">
        @error('stock')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        @error('description')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <input type="submit" value="Tambah">
</form>
@endsection