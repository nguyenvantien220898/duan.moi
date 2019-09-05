@extends('frontend.layouts.fashion')

@section('title')
    Tìm kiếm {{$search}}
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12 col-sm-12 women-dresses">

            @if($result->count() < 1)
                <h2>No Result {{$result->count()}}</h2>
            @endif
            <?php $i = 0?>
            <div class="women-set1">
                @foreach($result as $product)
                    <?php
                    $images = isset($product->images) && $product->images ? json_decode($product->images) : array();
                    ?>
                    <div class="col-md-4 women-grids wp1 animated wow slideInUp" data-wow-delay=".5s">
                        <a href="{{url('shop/product/'.$product->id)}}"><div class="product-img">
                                @if(count($images) > 0)
                                    @foreach($images as $image)
                                        <img src="{{asset($image)}}" alt="" />
                                        {{--Chỉ cần 1 hình--}}
                                        @break
                                    @endforeach
                                @endif
                                <div class="p-mask">
                                    <form action="{{url('shop/cart/add')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="cmd" value="_cart" />
                                        <input type="hidden" name="add" value="1" />
                                        <input type="hidden" name="w3ls1_item" value="{{$product->id}}" />
                                        <input type="hidden" name="amount" value="{{$product->priceSale}}" />
                                        <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                    </form>
                                </div>
                            </div></a>
                        <i class="fa fa-star yellow-star" aria-hidden="true"></i>
                        <i class="fa fa-star yellow-star" aria-hidden="true"></i>
                        <i class="fa fa-star yellow-star" aria-hidden="true"></i>
                        <i class="fa fa-star yellow-star" aria-hidden="true"></i>
                        <i class="fa fa-star gray-star" aria-hidden="true"></i>
                        <h4>{{$product->name}}</h4>
                        <h5>VND {{number_format($product->priceSale,0,'.','.')}}</h5>
                    </div>
                    <?php $i++?>
                    <?php if($i % 3 == 0):?>
                    <div class="clearfix"></div>
            </div>
            <div class="women-set{{$i/3 + 1}}">
                <?php endif;?>
                @endforeach
                <div class="clearfix"></div>
            </div>
            {{ $result->links() }}
        </div>
    </div>

@endsection