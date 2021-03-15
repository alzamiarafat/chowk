<div class="modal fade" id="productModal" z-index="9999" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-" role="document" id="modalDialogItem">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle" class="modal-title" id="modal-title-new-item"></h5>
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>--}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            {{--<style>--}}
                {{--.zoom_img:hover {--}}
                    {{---ms-transform: scale(1.5); /* IE 9 */--}}
                    {{---webkit-transform: scale(1.5); /* Safari 3-8 */--}}
                    {{--transform: scale(2.5);--}}
                {{--}--}}
            {{--</style>--}}
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="row">
                            <div class="col-sm col-md col-lg text-center" id="modalImgPart">
                                <img class="zoom_img" id="modalImg" src="" width="295px" height="200px">
                            </div>
                            <div class="col-sm col-md col-lg col-lg" id="modalItemDetailsPart">
                                <input id="modalID" type="hidden"></input>
                                <span id="modalPrice" class="new-price"></span>
                                <p id="modalDescription"></p>
                                <div id="variants-area">
                                    <label class="form-control-label">{{ __('Select your options') }}</label>
                                    <div id="variants-area-inside">
                                    </div>
                                </div>
                                <div id="exrtas-area">
                                    <br />
                                    <label class="form-control-label" for="quantity">{{ __('Extras') }} </label>
                                    <div id="exrtas-area-inside">
                                    </div>
                                </div>
                               @if(  !(isset($canDoOrdering)&&!$canDoOrdering)   )
                                <div class="quantity-area">
                                    <div class="form-group">
                                        <br />
                                        <label class="form-control-label" for="quantity">{{ __('Quantity') }}</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control form-control-alternative" placeholder="1" value="1" required autofocus>
                                    </div>
                                    <div class="quantity-btn float-right">
                                        <div id="addToCart1">
                                            <button class="btn btn-primary" v-on:click='addToCartAct'>{{ __('Add To Cart') }}</button>
                                        </div>
                                    </div>
                                </div>
                               @endif
                            </div>
                        </div>
{{--Changed By Mehraab Hossain--}}
                        <div class="container mt-3 border">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#description" role="tab" aria-controls="pills-home" aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#more_information" role="tab" aria-controls="pills-profile" aria-selected="false">More Information</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#review" role="tab" aria-controls="pills-contact" aria-selected="false">Customer Reviewe</a>
                                </li>
                            </ul>
                            <div class="tab-content border shadow" id="pills-tabContent">
                                <div class="tab-pane fade show active m-3" id="description" role="tabpanel" aria-labelledby="pills-home-tab"><p id="modalFullDescription"></p></div>
                                <div class="tab-pane fade m-3" id="more_information" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <p>Product Name:</p>
                                    <p>EMI Available:</p>
                                    <p>SKU</p>
                                    <p>A:</p>
                                    <p>B:</p>
                                    <p>C:</p>
                                    <p>D:</p>
                                </div>
                                <div class="tab-pane fade m-3" id="review" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam culpa dolor eos error exercitationem expedita harum, hic id mollitia necessitatibus nesciunt nisi sequi sint. Cupiditate fuga illum officia officiis ut.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="modal-import-restaurants" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-new-item">{{ __('Import restaurants from CSV') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="col-md-10 offset-md-1">
                        <form role="form" method="post" action="{{ route('import.restaurants') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group text-center{{ $errors->has('item_image') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="resto_excel">Import your file</label>
                                <div class="text-center">
                                    <input type="file" class="form-control form-control-file" name="resto_excel" accept=".csv, .ods, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                </div>
                            </div>
                            <input name="category_id" id="category_id" type="hidden" required>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@isset($restorant)
<div class="modal fade" id="modal-restaurant-info" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document" >
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card">
                    <div class="card-header bg-white text-center">
                        <img class="rounded img-center" src="{{ $restorant->icon }}" width="90px" height="90px"></img>
                        <h4 class="heading mt-4">{{ $restorant->name }} &nbsp;@if(count($restorant->ratings))<span><i class="fa fa-star" style="color: #dc3545"></i> <strong>{{ number_format($restorant->averageRating, 1, '.', ',') }} <span class="small">/ 5 ({{ count($restorant->ratings) }})</strong></span></span>@endif</h4>
                        <p class="description">{{ $restorant->description }}</p>
                        @if(!empty($openingTime) && !empty($closingTime))
                            <p class="description">{{ __('Open') }}: {{ $openingTime }} - {{ $closingTime }}</p>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{ __('About') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{ __('Reviews') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="heading-small">{{ __('Phone') }}</h6>
                                        <p class="heading-small text-muted">{{ $restorant->phone }}</p>
                                        <br/>
                                        <h6 class="heading-small">{{ __('Address') }}</h6>
                                        <p class="heading-small text-muted">{{ $restorant->address }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div id="map3" class="form-control form-control-alternative"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                @if(count($restorant->ratings) != 0)
                                    <br/>
                                    <h5>{{ count($restorant->ratings) }} {{ count($restorant->ratings) == 1 ? __('Review') : __('Reviews')}}</h5>
                                    <hr />
                                    
                                    @foreach($restorant->ratings as $rating)
                                        <div class="strip">
                                            <span class="res_title"><b>{{ $rating->user->name }}</b></span><span class="float-right"><i class="fa fa-star" style="color: #dc3545"></i> <strong>{{ number_format($rating->rating, 1, '.', ',') }} <span class="small">/ 5</strong></span></span><br />
                                            <span class="text-muted"> {{ $rating->created_at->format(env('DATETIME_DISPLAY_FORMAT','d M Y')) }}</span><br/>
                                            <br/>
                                            <span class="res_description text-muted">{{ $rating->comment }}</span><br />
                                        </div>
                                    @endforeach
                                @else
                                  <p>{{ __('There are no reviews yet.') }}<p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endisset


