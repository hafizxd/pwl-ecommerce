@extends('layouts.admin')

@section('title')
    Admin | Produk
@endsection

@section('content')
    <div class="product">
        <div>
            <a href="{{ route('admin.product.create') }}">Tambah</a>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>
                                @if(isset($product->image))
                                    <img src="{{ $product->image }}" alt="" style="width:100px;">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ currency($product->price) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <a href="{{ route('admin.product.edit', $product->id) }}">Edit</a>
                                <form action="{{ route('admin.product.delete', $product->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf

                                    <input type="submit" value="Hapus">
                                </form>
                            </td>
                        </tr>

                        @php $count++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection