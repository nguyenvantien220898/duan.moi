<div class="header-top-w3layouts">
    <div class="container">
        <div class="col-md-6 logo-w3">
            <a href="{{url('/')}}"><img src="{{asset($fe_global_settings['header_logo'])}}" alt=" " /><h1><?php echo ($fe_global_settings['web_name'])?></h1></a>
        </div>
        <div class="col-md-6 phone-w3l">
            <ul>
                <li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></li>
                <li>0972277598</li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="header-bottom-w3ls">
    <div class="container">
        <div class="col-md-7 navigation-agileits">
            <nav class="navbar navbar-default">
                <div class="navbar-header nav_2">
                    <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">

                    <?php echo $fe_menus_items_header_html ?>

                </div>
            </nav>
        </div>
        <script>
            $(document).ready(function(){
                $(".dropdown").hover(
                    function() {
                        $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
                        $(this).toggleClass('open');
                    },
                    function() {
                        $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
                        $(this).toggleClass('open');
                    }
                );
            });
        </script>
        <div class="col-md-4 search-agileinfo">
            <form action="{{url('/search')}}" method="get">
                @csrf
                <input type="search" name="Search" placeholder="Search for a Product..." required="">
                <button type="submit" class="btn btn-default search" aria-label="Left Align">
                    <i class="fa fa-search" aria-hidden="true"> </i>
                </button>
            </form>
        </div>
        <div class="col-md-1 cart-wthree">
            <div class="cart">
                <form action="{{url('/shop/cart')}}" method="post" class="last">

                    <button class="w3view-cart" type="submit" name="submit" value="">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                        <span id="num-cart">{{\Cart::getTotalQuantity()}}</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<style type="text/css">
    .w3view-cart{
        position: relative;
    }
    #num-cart{
        position: absolute;
        right: 0;
        bottom: 0;
        padding: 2px 5px;
        font-size: 10px;
        font-weight: bold;
        background: orange;
        color: white;
        border-radius: 50%;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        var add_cart_url =  '<?php echo url('shop/cart/add') ?>';
        $('.pw3ls-cart,.w3ls-cart').on('click',function(e){
            e.preventDefault();
            var dataPost = $(this).closest('form').serializeArray();
            //Post đến controller
            $.ajax(
                {
                    url: add_cart_url,
                    dataType: 'json',
                    type: 'POST',
                    data: dataPost,
                    success: function(result){
                        // Bung Popup => Show dialog
                        $('#myModal').modal('show');
                    }
                }
            );
        });
    });
</script>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Bạn đã thêm sản phẩm vào giỏ hàng thành công!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p style="text-align: center">
                    <a href="{{url('/shop/cart')}}" class="btn btn-success">Thanh toán</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tiếp tục mua sắm</button>
                </p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>