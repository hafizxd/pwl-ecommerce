@extends('layouts.user')

@section('title')
    Shoes Mart | Home
@endsection

@section('content')
    <div class="products">
        @foreach ($products as $key => $product)
            <div class="card">
                <div class="card-img">
                    <img src="{{ $product->image }}" alt="">
                </div>
                <div class="card-body">
                    <h3>{{ $product->name }}</h3>
                    <p><small>Stok : {{ $product->stock }}</small> <span>{{ currency($product->price) }}</span></p>
                </div>
                <div class="card-footer">
                    <form action="{{ route('cart.store', $product->id) }}" method="post">
                        @csrf
                        <div class="box">
                            <div class="quantity">
                                <span class="quantity-add quantity-button"></span>
                                <input type="number" name="quantity" step="1" min="{{ $product->stock > 1 ? '1' : '0' }}" max="{{ $product->stock ?? '0' }}" value="{{ $product->stock > 1 ? '1' : '0' }}">
                                <span class="quantity-remove quantity-button"></span>
                            </div>
                        </div>
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>  
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        $('.quantity-button').off('click').on('click', function () {
  
        if ($(this).hasClass('quantity-add')) {
            var addValue = parseInt($(this).parent().find('input').val()) + 1;
                $(this).parent().find('input').val(addValue).trigger('change');
            }

            if ($(this).hasClass('quantity-remove')) {
            var removeValue = parseInt($(this).parent().find('input').val()) - 1;
                if( removeValue < 0 ) {
                    removeValue = 0;
                }
                $(this).parent().find('input').val(removeValue).trigger('change');
            }

        });
    </script>
@endsection