@extends('layouts.admin')

@section('title')
    Admin | Order
@endsection

@section('content')
    <div class="order">
        <div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pemesan</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal Order</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>
                                @if(isset($order->product->image))
                                    <img src="{{ $order->product->image }}" alt="" style="width:100px;">
                                @endif
                                {{ $order->product->name }}
                            </td>
                            <td>{{ $order->quantity }}</td>
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
                            <td style="text-align: center;">
                                {{-- <a href="{{ route('admin.order.detail', $order->id) }}">Detail</a> --}}
                                @if (! $order->is_shipped)
                                    <form action="{{ route('admin.order.confirm', $order->id) }}" method="post">
                                        @method('PUT')
                                        @csrf

                                        <input type="submit" value="Kirim Pesanan">
                                    </form>
                                @else 
                                    -
                                @endif
                            </td>
                        </tr>

                        @php $count++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection