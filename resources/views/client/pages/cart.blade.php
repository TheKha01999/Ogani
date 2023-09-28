@extends('client.layout.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/client/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="table-cart">
                                {{-- {{ dd($carts) }} --}}
                                @php $total = 0 @endphp
                                @foreach ($carts as $productID => $cart)
                                    @php $total += $cart['qty'] * $cart['price'] @endphp
                                    <tr id="{{ $productID }}">
                                        <td class="shoping__cart__item">
                                            <img src="{{ $cart['image'] ?? '' }}" alt="">
                                            <h5>{{ $cart['name'] }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{ $cart['price'] }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty" data-price="{{ $cart['price'] }}"
                                                    data-id="{{ $productID }}"
                                                    data-url="{{ route('product.update-item-in-cart', ['productId' => $productID]) }}">
                                                    <input type="text" class="qty" value="{{ $cart['qty'] }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            {{ $cart['price'] * $cart['qty'] }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <span data-id="{{ $productID }}"
                                                data-url="{{ route('product.delete-item-from-cart', ['productId' => $productID]) }}"
                                                class="icon_close"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a data-url="{{ route('product.delete-all') }}" href="#"
                            class="primary-btn cart-btn cart-btn-right delete-all">
                            <span class="icon_user"">
                            </span>
                            Delete All
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span class="sub-total">${{ number_format($total, 2) }}</span></li>
                            <li>Total <span class="sub-total">${{ number_format($total, 2) }}</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection


@section('js-custom')
    <script>
        $(document).ready(function() {
            $(".icon_close").click(function() {
                let url = $(this).data('url');
                let id = $(this).data('id');
                $.ajax({
                    method: "get",
                    url: url,
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            text: res.message,
                        })
                        $(`tr#${id}`).empty();
                    }
                });

            });

            $(".qtybtn").click(function() {
                let button = $(this);
                let id = button.parent().data('id');

                let qty = parseInt(button.siblings('.qty').val());
                let url = button.parent().data('url');


                if (button.hasClass('inc')) {
                    qty += 1;
                } else {
                    qty = (qty < 0) ? 0 : (qty -= 1);
                }

                let price = parseFloat(button.parent().data('price'));
                let totalPrice = price * qty;

                url = `${url}/${qty}`;

                $.ajax({
                    method: "get",
                    url: url,
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            text: res.message,
                        })
                        if (qty === 0) {
                            $('tr#' + id).empty();
                        }
                        $('tr#' + id + ' .shoping__cart__total').html("$" + totalPrice.toFixed(
                                2)
                            .replace(
                                /(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));



                        $('#total-items-cart').html(res.total_items);

                        $('#total-price-cart').html('$' + res.total_price.toFixed(2)
                            .replace(
                                /(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                        $('.sub-total').html('$' + res.total_price.toFixed(2)
                            .replace(
                                /(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

                    }
                });

            });

            $(".delete-all").click(function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                $.ajax({
                    method: "get",
                    url: url,
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            text: res.message,
                        })

                        $('#table-cart').empty();

                        $('#total-items-cart').html(res.total_items);

                        $('#total-price-cart').html('$' + res.total_price.toFixed(2)
                            .replace(
                                /(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                        $('.sub-total').html('$' + res.total_price.toFixed(2)
                            .replace(
                                /(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

                    }
                });

            });
        });
    </script>
@endsection
