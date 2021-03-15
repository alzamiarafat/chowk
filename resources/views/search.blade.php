@extends('layouts.front', ['class' => ''])
@section('content')

<div class="container">
    <div>
        <h2>Search Result</h2>
        <div>

            {{--@foreach($products as $item)--}}
                {{--<div>--}}
                    {{--<p>name : {{ $item->name }}</p>--}}
                    {{--<p>Description : {{ $item->description }}</p>--}}
                    {{--<p>Image : {{ $item->image }}</p>--}}
                    {{--<p>Price : {{ $item->price }}</p>--}}
                {{--</div>--}}
                {{--@endforeach--}}

            <div class="row">
                @foreach ($products as $item)
                    <input type="text" id="rid" value="{{ $item->category->restorant_id}}"/>

                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 ">

                        <div class="strip">
                            @if(!empty($item->image))
                                <div>
                                    @if($item->discount>0)
                                        <div>
                                        <!--<span class="text-light discount" stytle="background:#e52923; color:#FFF">{{$item->discount}} Off</span>-->
                                            <span class="discount" stytle="background:#e52923; color:#FFF">
                                   @if($item->discount_type==1)
                                                    @money($item->discount, config('settings.cashier_currency'),config('settings.do_convertion')) OFF</td>
                                                @else
                                                <!--($item->price-($item->price-$item->discount), config('settings.cashier_currency'),config('settings.do_convertion'))-->
                                                    {{$item->discount}} % OFF
                                            @endif

                                            <!--@money($item->discount, config('settings.cashier_currency'),config('settings.do_convertion')) Off-->
                                </span>
                                        </div>
                                    @endif
                                    <div class="figure">
                                        <a data-toggle="tooltip" title="{{$item->name}}" onClick="setCurrentItem({{ $item->id }})" href="javascript:void(0)"><span class="bg-danger"></span><img src="{{ $item->logom }}" loading="lazy" data-src="{{ config('global.restorant_details_image') }}" class="img-fluid lazy" alt=""></a>
                                    </div>
                                </div>
                            <!--<span style="display:inline-block;width:arrow_width;height:arrow_height;background-image:url({{ $item->logom }});">25%</span>-->
                            <!--<div class="d-flex justify-content-between align-items-center p-2 first"> <span class="percent">-25%</span></div> <img src="{{ $item->logom }}" loading="lazy" data-src="{{ config('global.restorant_details_image') }}" class="img-fluid lazy" alt="">-->
                            @endif
                            <span class=""><a data-toggle="tooltip" title="See More Details" onClick="setCurrentItem({{ $item->id }})" href="javascript:void(0)"><p>{{ \Illuminate\Support\Str::limit($item->name, 20, $end='...')}}</p></a></span>

                        <!--<span class="res_description">{{ $item->short_description}}</span><br />-->
                        <!--@if(strlen($item->name)<24)-->
                            <!--</br>-->
                            <!--@endif-->

                            @if($item->discount>0)
                                <div class="row ">
                                    <del><span class="col-6 text-danger">৳ {{(int)$item->regular_price}}</span></del></br>
                                    <span class="col-6 float-right">
                                    <!--@money(ceil($item->price), config('settings.cashier_currency'),config('settings.do_convertion'))-->
                                        <!--@money((int)$item->price, config('settings.cashier_currency'),config('settings.do_convertion'))-->
                                     ৳ {{(int)$item->price}}
                                </span>
                                </div>
                            @endif
                            @if($item->discount==0||$item->discount==NULL)
                            <!--<span class="">@money((int)$item->price, config('settings.cashier_currency'),config('settings.do_convertion'))</span>-->
                                <span class="">৳ {{(int)$item->price}}</span>
                            @endif
                            <div class="text-center p-2" style="background:#283747">
                                <a onClick="setCurrentItem({{ $item->id }})" href="javascript:void(0)"><span class="text-white"><i class="fa fa-shopping-cart mr-2"></i>Add to cart</span></a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


<section class="row row-grid align-items-center section d-none d-md-block" style="  ">
    @if(config('global.playstore') || config('global.appstore'))

        <div class="container py-md">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-4">
                    <h2 class="">{{ __(config('global.mobile_info_title')) }}</h2>
                    <h4 class="mb-0 font-weight-light">{{ __(config('global.mobile_info_subtitle')) }}</h4>
                    <div class="row">
                        @if(config('global.playstore'))
                            <div class="col-6">
                                <a href="{{config('global.playstore')}}" target="_blank"><img class="img-fluid" src="/default/playstore.png" alt="..."/></a>
                            </div>
                        @endif
                        @if(config('global.appstore'))
                            <div class="col-6">
                                <a href="{{config('global.appstore')}}" target="_blank"><img class="img-fluid" src="/default/appstore.png" alt="..."/></a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6 ">
                            <img src="https://d2sz1kgdtrlf1n.cloudfront.net/task_images/bTRB1606789921031-MobileUI014.png" alt="" class="w-50">
                        </div>
                        <div class="col-lg-6">
                            <img src="https://d2sz1kgdtrlf1n.cloudfront.net/task_images/2xhp1606790013778-MobileUI023.png" alt="" class="w-50">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
    @endif
    @endsection