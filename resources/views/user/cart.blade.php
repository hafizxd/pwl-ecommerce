@extends('layouts.user')

@section('title')
    Shoes Mart | Cart
@endsection

@section('content')
    <div class="cart">
        <div class="links">
            <form action="{{ route('cart.delete-all') }}" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" value="Kosongkan Cart">
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width:10px;">#</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(count($carts) > 0)
                    @php $count = 1; @endphp

                    @foreach($carts as $key => $cart)
                        <tr>
                            <td class="center">{{ $count }}</td>
                            <td class="center">
                                <img src="{{ $cart->product->image }}" alt="">  
                            </td>
                            <td>{{ $cart->product->name }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{ currency($cart->product->price) }}</td>
                            <td>{{ currency($cart->product->price * $cart->quantity) }}</td>
                            <td class="center">
                                <form action="{{ route('cart.delete', $cart->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" value="Hapus">
                                </form>
                            </td>
                        </tr>
                        @php $count++; @endphp
                    @endforeach

                    <tr class="price-total">
                        <th colspan="3"></th>
                        <th colspan="2">Total harga :</th>
                        <th class="left" colspan="2">{{ currency($totalPrice) }}</th>
                    </tr>
                @else
                    <tr>
                        <td colspan="7" class="center">Tidak ada data dalam keranjang.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        
        @if(count($carts) > 0)
            <div class="checkout">
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <input type="submit" value="Checkout">
                </form>
            </div>
        @endif
    </div>
@endsection