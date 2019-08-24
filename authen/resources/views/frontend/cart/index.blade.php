@extends('frontend.layouts.fashion')
@section('title')
    Giỏ hàng
@endsection
@section('content')
    <style type="text/css">
        #custom_cart .banner-bottom, .team, .checkout, .additional_info, .team-bottom, .single, .mail, .special-deals, .about, .faq, .typo, .new-products, .banner-bottom1, .top-brands, .dresses, .w3l_related_products {
            padding: 5em 0; }
        #custom_cart .checkout h3 {
            font-size: 1em;
            color: #212121;
            text-transform: uppercase;
            margin: 0 0 3em;
        }
        #custom_cart .checkout h3 span {
            color: #ff9b05;
        }
        #custom_cart table.timetable_sub {
            width: 100%;
            margin: 0 auto;
        }
        #custom_cart .timetable_sub thead {
            background: #F2F2F2;
        }
        #custom_cart .timetable_sub th:nth-child(1) {
            border-left: 1px solid #C5C5C5;
        }
        #custom_cart .timetable_sub th, .timetable_sub td {
            text-align: center;
            padding: 7px;
            font-size: 14px;
            color: #212121;
        }
        #custom_cart .timetable_sub td {
            border: 1px solid #CDCDCD;
        }
        #custom_cart .quantity-select .entry.value-minus, .quantity-select .entry.value-minus1 {
            margin-left: 0;
        }
        #custom_cart .value, .value1 {
            cursor: default;
            width: 40px;
            height: 40px;
            padding: 8px 0px;
            color: #A9A9A9;
            line-height: 24px;
            border: 1px solid #E5E5E5;
            background-color: #E5E5E5;
            text-align: center;
            display: inline-block;
            margin-right: 3px;
        }
        #custom_cart .value-minus, .value-plus, .value-minus1, .value-plus1 {
            height: 40px;
            line-height: 24px;
            width: 40px;
            margin-right: 3px;
            display: inline-block;
            cursor: pointer;
            position: relative;
            font-size: 18px;
            color: #fff;
            text-align: center;
            -webkit-user-select: none;
            -moz-user-select: none;
            border: 1px solid #b2b2b2;
            vertical-align: bottom;
        }
        #custom_cart .rem {
            position: relative;
        }
        #custom_cart .checkout-left {
            margin: 2em 0 0;
        }
        #custom_cart .checkout-left-basket {
            float: left;
            width: 25%;
        }
        #custom_cart .checkout-left-basket h4 {
            padding: 1em;
            background: #ff9b05;
            font-size: 1.1em;
            color: #fff;
            text-transform: uppercase;
            text-align: center;
            margin: 0 0 1em;
        }
        #custom_cart ul, label {
            margin: 0;
            padding: 0;
        }
        #custom_cart .checkout-left-basket ul li {
            list-style-type: none;
            margin-bottom: 1em;
            font-size: 14px;
            color: #999;
        }
        #custom_cart .checkout-left-basket ul li span {
            float: right;
        }
        #custom_cart .checkout-right-basket {
            float: right;
            margin: 8em 0 0 0em;
        }
        #custom_cart .checkout-right-basket a {
            padding: 10px 30px;
            color: #fff;
            font-size: 1em;
            background: #212121;
            text-decoration: none;
        }
        #custom_cart .checkout-right-basket a span {
            left: -.5em;
            top: 0.1em;
        }
        #custom_cart .glyphicon {
            position: relative;
            top: 1px;
            display: inline-block;
            font-family: 'Glyphicons Halflings';
            font-style: normal;
            font-weight: normal;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        #custom_cart .checkout-left-basket ul li:nth-child(5) {
            font-size: 1em;
            color: #212121;
            font-weight: 600;
            padding: 1em 0;
            border-top: 1px solid #DDD;
            border-bottom: 1px solid #DDD;
            margin: 2em 0 0;
        }
        #custom_cart .close1, .close2, .close3 {
            /*background: url(frontend_assets/images/remove.png) no-repeat 0px 0px;*/
            cursor: pointer;
            width: 32px;
            height: 32px;
            position: absolute;
            right: 15px;
            top: -13px;
            -webkit-transition: color 0.2s ease-in-out;
            -moz-transition: color 0.2s ease-in-out;
            -o-transition: color 0.2s ease-in-out;
            transition: color 0.2s ease-in-out;
        }
    </style>
    <div id="custom_cart">
        <div class="checkout">
            <div class="container">
                <h3>Your shopping cart contains: <span>{{\Cart::getTotalQuantity()}} Products</span></h3>
                <!---728x90--->

                <div class="checkout-right">
                    <table class="timetable_sub">
                        <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;?>
                        @foreach($cart_products as $product)
                            <tr class="rem{{$i}}">
                                <td class="invert">{{$i}}</td>
                                <td class="invert-image">
                                    <a href="{{url('shop/product/'.$product->id)}}">
                                        <?php
                                        $images = $product->attributes->image ? json_decode($product->attributes->image) : array();
                                        ?>
                                        @foreach($images as $image)
                                            <img src="{{asset($image)}}" style="max-width: 150px;margin: 10px auto;" class="img-responsive">
                                            @break
                                        @endforeach
                                    </a>
                                </td>
                                <td class="invert">
                                    <div class="quantity">
                                        <div class="quantity-select">
                                            <div class="entry value-minus" data-id="{{$product->id}}">&nbsp;</div>
                                            <div class="entry value"><span>{{$product->quantity}}</span></div>
                                            <div class="entry value-plus active" data-id="{{$product->id}}">&nbsp;</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="invert">{{$product->name}}</td>
                                <td class="invert">VND {{number_format($product->price,0,'.','.')}}</td>
                                <td class="invert">VND {{number_format(($product->price) * ($product->quantity),0,'.','.')}}</td>
                                <td class="invert">
                                    <div class="rem">
                                        <div class="close{{$i}}" data-id="{{$product->id}}">Remove</div>
                                        @csrf
                                    </div>
                                    <script>
                                        $(document).ready(function(c) {
                                            $('.close{{$i}}').on('click', function(c){
                                                var add_cart_url =  '<?php echo url('shop/cart/remove') ?>';
                                                var product_id = $(this).data('id');
                                                var token = $('input[name="_token"]').val();
                                                var dataPost = {product_id : product_id, '_token' : token};
                                                //Post đến controller
                                                $.ajax(
                                                    {
                                                        url: add_cart_url,
                                                        dataType: 'json',
                                                        type: 'POST',
                                                        data: dataPost,
                                                        success: function(result){
                                                            $('.rem{{$i}}').fadeOut('slow', function(c){
                                                                $('.rem{{$i}}').remove();
                                                            });
                                                        }
                                                    }
                                                );
                                            });
                                        });
                                    </script>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach

                        <!--quantity-->
                        <script>
                            $('.value-plus').on('click', function(){
                                var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
                                divUpd.text(newVal);
                                var add_cart_url =  '<?php echo url('shop/cart/update') ?>';
                                var product_id = $(this).data('id');
                                var token = $('input[name="_token"]').val();
                                var dataPost = {product_id : product_id,quantity: newVal, '_token' : token};
                                //Post đến controller
                                $.ajax(
                                    {
                                        url: add_cart_url,
                                        dataType: 'json',
                                        type: 'POST',
                                        data: dataPost,
                                        success: function(result){
                                            location.reload();
                                        }
                                    }
                                );
                            });
                            $('.value-minus').on('click', function(){
                                var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
                                if(newVal>=1) divUpd.text(newVal);
                                var add_cart_url =  '<?php echo url('shop/cart/update') ?>';
                                var product_id = $(this).data('id');
                                var token = $('input[name="_token"]').val();
                                var dataPost = {product_id : product_id,quantity: newVal, '_token' : token};
                                //Post đến controller
                                $.ajax(
                                    {
                                        url: add_cart_url,
                                        dataType: 'json',
                                        type: 'POST',
                                        data: dataPost,
                                        success: function(result){
                                            location.reload();
                                        }
                                    }
                                );
                            });
                        </script>
                        <!--quantity-->
                        </tbody></table>
                </div>
                <div class="checkout-left">
                    <div class="checkout-left-basket">
                        <h4><a href="{{url('/shop/payment')}}" style="color: white;">Continue to basket</a></h4>
                        <ul>
                            @foreach($cart_products as $product)
                                <li>{{$product->name}} <i>-</i> <span>VND {{number_format(($product->price) * ($product->quantity),0,'.','.')}}</span></li>
                            @endforeach
                            <li style="font-weight: bold">Total <i>-</i> <span>VND {{number_format($total_payment,0,'.','.')}}</span></li>
                        </ul>
                    </div>
                    <div class="checkout-right-basket">
                        <a href="{{url('/')}}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>

    </div>
@endsection