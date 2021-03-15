<div class="card card-profile shadow mt--450" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="">
      {{--<div class="mt-5">--}}
        {{--<h3>{{ __('Items') }}<span class="font-weight-light"></span></h3>--}}
      {{--</div>--}}
        <!-- List of items -->
          <style>
              .table td, .table th {
                  /* padding: 1rem; */
                  vertical-align: top;
                  height: 5%;
                  /* border-top: .0625rem solid #dee2e6; */
              }
          </style>
        <div  id="cartList" class="">
            <br />
            <div  v-for="item in items" class="items col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
                <div class=" clearfix" v-cloak>
                    {{--<div class="square-box pull-left">--}}
                    <table class="table" >
                    <tbody>
                        <tr>
                            <td style="width: 10%; height: 5%; padding:0px;    border-top: none;">
                                    <img :src="item.attributes.image" :data-src="item.attributes.image"  class="" width="80px" height="30px" alt="">
                            </td>
                            <td style="width: 45%; padding: 0px;border-top: none; padding-left: 2px">
                                <span class="product-item_title" style="font-size: 13px">@{{ item.name }} <br><p style="font-size: 10px">@{{ item.attributes.friendly_price }}</p></span>
                            </td>
                            <td style="width: 20%; padding: 0px;    border-top: none;">
                                <span class="product-item_title" style="font-size: 13px">৳ @{{(item.price)*(item.quantity)}}</span>

                            </td>
                            <td style="width: 15%;padding: 0px;    border-top: none;">
                                {{--<p class="product-item_quantity">@{{ item.quantity }} x @{{ item.attributes.friendly_price }}</p>--}}
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" v-on:click="decQuantity(item.id)" :value="item.id">
                                        <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-chevron-down"></i></span>
                                    </button>
                                    <span class="p-2">@{{ item.quantity }}</span>
                                    <button type="button" v-on:click="incQuantity(item.id)" :value="item.id" >
                                        <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-chevron-up"></i></span>
                                    </button>
                                </div>
                            </td>
                            <td style="width: 10%;padding: 0px;    border-top: none;">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" v-on:click="remove(item.id)"  :value="item.id" class="btn btn-outline-primary btn-icon btn-sm page-link">
                                        <span class="btn-inner--icon btn-cart-icon"><i class="fa fa-trash"></i></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End List of items -->
    </div>
</div>


