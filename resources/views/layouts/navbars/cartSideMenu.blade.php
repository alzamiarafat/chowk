<div id="cartSideNav" class="sidenav-cart sidenav-cart-close">
    <div class="offcanvas-menu-inner">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="minicart-content">
            {{--<div class="minicart-heading">--}}
                {{--<h4>{{ __('Shopping Cart') }}</h4>--}}
            {{--</div>--}}
            <div class="searchable-container">
                <div id="cartList">
                    <div v-for="item in items" class="items col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
                        <div class="info-block block-info clearfix" v-cloak>
                            <div class="d-flex flex-row">
                                <img :src="item.attributes.image"  class="productImage" width="40px" height="40px" alt="">
                                <span class="product-item_title" style="font-size: 13px">@{{ item.name }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="product-item_quantity">@{{ item.quantity }} x @{{ item.attributes.friendly_price }}</p>
                                </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" v-on:click="decQuantity(item.id)" :value="item.id"class="btn  btn-sm" >
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" v-on:click="incQuantity(item.id)" :value="item.id" class="btn btn-sm">
                                    <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-plus"></i></span>
                                </button>
                                <button type="button" v-on:click="remove(item.id)"  :value="item.id" class="btn btn-sm">
                                    <span class="btn-inner--icon "><i class="fa fa-trash"></i></span>
                                </button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="totalPrices" v-cloak>
                    <div  class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span v-if="totalPrice==0">{{ __('Cart is empty') }}!</span>
                                    <span v-if="totalPrice"><strong>{{ __('Subtotal') }}:</strong></span>
                                    <span v-if="totalPrice" class="ammount float-right"><strong>@{{ totalPriceFormat }}</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div v-if="totalPrice" v-cloak>
                        <a href="/cart-checkout" class="btn btn-primary text-white" style="background: #e52923">{{ __('Checkout') }}</a>
                    </div>
                    <br/>
                    <div v-if="totalPrice" v-cloak class="text-center mobile-menu">
                        <a type="button" class="btn btn-default btn-block text-white btn-sm" style="text-transform:none" onclick="closeNav()">{{ __('Continue Shopping') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
