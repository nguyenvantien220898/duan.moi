<div class="header-top-w3layouts">

    <div class="container">
        <div class="col-md-6 logo-w3">
            <a href="index.html"><img src="{{asset('frontend_assets/images')}}/logo2.png" alt=" " /><h1>FASHION<span>CLUB</span></h1></a>
        </div>
        <div class="col-md-6 phone-w3l">
            <ul>
                <li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></li>
                <li>+18045403380</li>
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
            <form action="#" method="post">
                <input type="search" name="Search" placeholder="Search for a Product..." required="">
                <button type="submit" class="btn btn-default search" aria-label="Left Align">
                    <i class="fa fa-search" aria-hidden="true"> </i>
                </button>
            </form>
        </div>
        <div class="col-md-1 cart-wthree">
            <div class="cart">
                <form action="#" method="post" class="last">
                    <input type="hidden" name="cmd" value="_cart" />
                    <input type="hidden" name="display" value="1" />
                    <button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>