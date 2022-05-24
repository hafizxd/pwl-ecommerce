@extends('layouts.user')

@section('title')
    Shoes Mart | Cart
@endsection

@section('content')
    <div class="order">
        <table>
            <thead>
                <tr>
                    <th style="width:10px;">#</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Harga</th>
                    <th>Tanggal Order</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if(count($orders) > 0)
                    @php $count = 1; @endphp

                    @foreach($orders as $key => $order)
                        <tr>
                            <td class="center">{{ $count }}</td>
                            <td class="center">
                                <img src="{{ asset('storage/uploads/products/' . $order->product->image) }}" alt="">  
                            </td>
                            <td>{{ $order->product->name }}</td>
                            <td class="center">{{ $order->quantity }}</td>
                            <td>{{ currency($order->product->price) }}</td>
                            <td>{{ currency($order->product->price * $order->quantity) }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->ordered_at)->format('d-m-Y') }}</td>
                            <td style="text-align: center;">
                                @if ($order->is_shipped)
                                    <p>Telah Dikirim</p>
                                    <small> pada {{ \Carbon\Carbon::parse($order->is_shipped_at)->format('d-m-Y') }} </small>
                                @else
                                    <p>Belum Dikirim</p>
                                @endif
                            </td>
                        </tr>
                        @php $count++; @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="center">Tidak ada order.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection