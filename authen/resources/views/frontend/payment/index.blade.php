@extends('frontend.layouts.fashion')
@section('title')
    Thanh toán
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
                                    {{$product->quantity}}
                                </td>
                                <td class="invert">{{$product->name}}</td>
                                <td class="invert">VND {{number_format($product->price,0,'.','.')}}</td>
                                <td class="invert">VND {{number_format(($product->price) * ($product->quantity),0,'.','.')}}</td>
                            </tr>
                            <?php $i++;?>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
    <style type="text/css">
        #w3Payment {
            margin-top: 20px;
        }
        #w3Payment .row {
            display: -ms-flexbox; /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap; /* IE10 */
            flex-wrap: wrap;
            margin: 0 -16px;
        }
        #w3Payment .col-25 {
            -ms-flex: 25%; /* IE10 */
            flex: 25%;
        }
        #w3Payment .col-50 {
            -ms-flex: 50%; /* IE10 */
            flex: 50%;
        }
        #w3Payment .col-75 {
            -ms-flex: 75%; /* IE10 */
            flex: 75%;
        }
        #w3Payment .col-25,
        .col-50,
        .col-75 {
            padding: 0 16px;
        }
        #w3Payment .container {
            padding: 5px 20px 15px 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }
        #w3Payment input[type=text] {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        #w3Payment label {
            margin-bottom: 10px;
            display: block;
        }
        #w3Payment .icon-container {
            margin-bottom: 20px;
            padding: 7px 0;
            font-size: 24px;
        }
        #w3Payment .btn {
            background-color: #00e58b;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
        }
        #w3Payment .btn:hover {
            background-color: #00e58b;
            opacity: 0.7;
        }
        #w3Payment span.price {
            float: right;
            color: grey;
        }
        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
        @media (max-width: 800px) {
            #w3Payment .row {
                flex-direction: column;
            }
            #w3Payment .col-25 {
                margin-bottom: 20px;
                display:none;
            }
        }
    </style>

    <h1>VND {{number_format($total_payment,0,'.','.')}}</h1>
    <div id="w3Payment">
        <div class="row">
            <div class="col-75" style="margin-top: 20px">
                <div class="container">
                    <form name="order_form" action="{{url('shop/payment')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-50">
                                <h3>Billing Address</h3>
                                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                <input type="text" id="fname" name="customer_name" placeholder="John M. Doe">
                                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                <input type="text" id="email" name="customer_email" placeholder="john@example.com">
                                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                <input type="text" id="adr" name="customer_address" placeholder="542 W. 15th Street">
                            </div>

                            <div class="col-50">
                                <h3>Payment</h3>
                                <label for="fname">Accepted Cards</label>
                                <div class="icon-container">
                                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                                </div>
                                <label for="city"><i class="fa fa-institution"></i> City</label>
                                <input type="text" id="city" name="customer_city" placeholder="New York">

                                <div class="row">
                                    <div class="col-50">
                                        <label for="state">Country</label>
                                        <input type="text" id="customer_country" name="customer_country" placeholder="VN">
                                    </div>
                                    <div class="col-50">
                                        <label for="zip">Phone</label>
                                        <input type="text" id="customer_phone" name="customer_phone" placeholder="0981234567">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="cname">Note</label>
                            <textarea name="customer_note" style="width: 100%" rows="10"></textarea>
                        </div>
                        <input type="submit" value="Continue to checkout" class="btn">
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection