@extends('layouts.app', ['title' => __('Restaurant Menu Management')])
@section('admin_title')
    {{__('Menu')}}
@endsection
@section('content')
    @include('items.partials.modals')
    @include('items.partials.header', ['title' => __('Edit Restaurant Menu')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-0">{{ __('Restaurant Menu Management') }} @if(config('settings.enable_miltilanguage_menus')) ({{ $currentLanguage}}) @endif</h3>
                                        
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-icon btn-1 btn-sm btn-primary" type="button" data-toggle="modal" data-target="#modal-items-category" data-toggle="tooltip" data-placement="top" title="{{ __('Add new category')}}">
                                            <span class="btn-inner--icon"><i class="fa fa-plus"></i> {{ __('Add new category') }}</span>
                                        </button>
                                        @if($canAdd)
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-import-items" onClick=(setRestaurantId({{ $restorant_id }}))>
                                                <span class="btn-inner--icon"><i class="fa fa-file-excel"></i> {{ __('Import from CSV') }}</span>
                                            </button>
                                        @endif
                                        @if(config('settings.enable_miltilanguage_menus'))
                                            @include('items.partials.languages')
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="col-12">
                        @include('partials.flash')
                    </div>
                    <div class="card-body">
                        @foreach ($categories as $category)
                        @if($category->active == 1)
                        <div class="alert alert-default">
                            <div class="row">
                                <div class="col">
                                    <span class="h1 font-weight-bold mb-0 text-white">{{ $category->name }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="row">
                                        <script>
                                            function setSelectedCategoryId(id){
                                                $('#category_id').val(id);
                                            }

                                            function setRestaurantId(id){
                                                $('#res_id').val(id);
                                            }

                                        </script>
                                        @if($canAdd)
                                            <button class="btn btn-icon btn-1 btn-sm btn-primary" type="button" data-toggle="modal" data-target="#modal-new-item" data-toggle="tooltip" data-placement="top" title="{{ __('Add item') }} in {{$category->name}}" onClick=(setSelectedCategoryId({{ $category->id }})) >
                                                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                                            </button>
                                        @else
                                            <a href="{{ route('plans.current')}}" class="btn btn-icon btn-1 btn-sm btn-warning" type="button"  >
                                                <span class="btn-inner--icon"><i class="fa fa-plus"></i> {{ __('Menu size limit reaced') }}</span>
                                            </a>
                                        @endif
                                        <button class="btn btn-icon btn-1 btn-sm btn-warning" type="button" id="edit" data-toggle="modal" data-target="#modal-edit-category" data-toggle="tooltip" data-placement="top" title="{{ __('Edit category') }} {{ $category->name }}" data-id="<?= $category->id ?>" data-name="<?= $category->name ?>" >
                                            <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>
                                        </button>
                                        <form action="{{ route('categories.destroy', $category) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-icon btn-1 btn-sm btn-danger" type="button" onclick="confirm('{{ __("Are you sure you want to delete this category?") }}') ? this.parentElement.submit() : ''" data-toggle="tooltip" data-placement="top" title="{{ __('Delete') }} {{$category->name}}">
                                                <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($category->active == 1)
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="row row-grid">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Regular Price</th>
      <th scope="col">Discount</th>
      <th scope="col">New Price</th>
      <th scope="col">Status</th>
      <th scope="col">Stock</th>
      <th scope="col-2">Modify</th>
    </tr>
  </thead>
  <tbody>
      @foreach ( $category->items as $item)
    <tr>
        <!--name-->
      <td>{{ $item->name }}</td>
      <!--regular price-->
      <td>৳ {{$item->regular_price}}</td>
      <!--Discount-->
      <td>
          @if($item->discount_type==0|| $item->discount_type==1)
           {{$item->discount}}</td>
          @else
           <!--($item->price-($item->price-$item->discount), config('settings.cashier_currency'),config('settings.do_convertion'))-->
           {{$item->discount}} %
           @endif
           </td>
           
          
         <!--New Price-->
      <td>
      @money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))
      </td>
<!--Status-->
      <td>
        <p class="text-sm">
            @if($item->available == 1)
            <span class="text-success">{{ __("AVAILABLE") }}</span>
            @else
            <span class="text-danger">{{ __("UNAVAILABLE") }}</span>
            @endif
        </p>
      </td>
      <!--Stock-->
      <td>
          <!--@if($item->discount_type==0)-->
          <!--{{$item->price}}-->
          <!--@elseif($item->discount_type==1)-->
          <!--@money($item->price-$item->discount, config('settings.cashier_currency'),config('settings.do_convertion'))-->
          <!--@else-->
          <!--@money($item->price-(($item->price*$item->discount)/100), config('settings.cashier_currency'),config('settings.do_convertion'))-->
          <!--@endif-->
      </td>
      <!--MODIFY-->
      <td>
          <div class="row">
        <a href="{{ route('items.edit', $item) }}" >
            <button class="btn btn-icon btn-1 btn-sm btn-primary bg-success" type="button"  title="Edit Item {{ $item->name }}" >
            <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>
            </button>
        </a>
        <a>
            <form action="{{ route('items.destroy', $item) }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-icon btn-1 btn-sm btn-danger ml-1" type="button"  title="Delete Item {{ $item->name }}" onclick="confirm('{{ __("Are you sure you want to delete this item?") }}') ? this.parentElement.submit() : ''">
                <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
            </button>
            </form>
        </a>
        </div>
        </td>
    </tr>
     @endforeach
  </tbody>
</table>
                                    
                                    
                                    <!--@foreach ( $category->items as $item)-->
                                    <!--    <div class="col-lg-2">-->
                                    <!--        <a href="{{ route('items.edit', $item) }}">-->
                                    <!--            <div class="card">-->
                                    <!--                <img class="card-img-top" src="{{ $item->logom }}" alt="...">-->
                                    <!--                <div class="card-body">-->
                                    <!--                    <h4 class="card-title text-primary text-uppercase">{{ $item->name }}</h4>-->
                                    <!--                    <p class="card-text description mt-3">{{ $item->description }}</p>-->
                                    <!--                    @if($item->discount>0)-->
                                    <!--                    <span class="badge badge-danger badge-pill"><del>@money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))</del></span>-->
                                    <!--                    <span class="badge badge-success badge-pill">@money($item->price-$item->discount, config('settings.cashier_currency'),config('settings.do_convertion'))</span></br>-->
                                    <!--                    <span class="badge badge-primary badge-pill">Discount Amount: @money($item->price-($item->price-$item->discount), config('settings.cashier_currency'),config('settings.do_convertion'))</span>-->
                                    <!--                    @endif-->
                                    <!--                     @if($item->discount==0||$item->discount==NULL)-->
                                    <!--                    <span class="badge badge-primary badge-pill">@money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))</span>-->
                                    <!--                    @endif-->
                                    <!--                    <p class="mt-3 mb-0 text-sm">-->
                                    <!--                        @if($item->available == 1)-->
                                    <!--                        <span class="text-success mr-2">{{ __("AVAILABLE") }}</span>-->
                                    <!--                        @else-->
                                    <!--                        <span class="text-danger mr-2">{{ __("UNAVAILABLE") }}</span>-->
                                    <!--                        @endif-->
                                    <!--                    </p>-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--            <br/>-->
                                    <!--        </a>-->
                                    <!--    </div>-->
                                    <!--@endforeach-->
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <!--@if($category->active == 1)-->
                        <!--<div class="row justify-content-center">-->
                        <!--    <div class="col-lg-12">-->
                        <!--        <div class="row row-grid">-->
                        <!--            @foreach ( $category->items as $item)-->
                        <!--                <div class="col-lg-3">-->
                        <!--                    <a href="{{ route('items.edit', $item) }}">-->
                        <!--                        <div class="card">-->
                        <!--                            <img class="card-img-top" src="{{ $item->logom }}" alt="...">-->
                        <!--                            <div class="card-body">-->
                        <!--                                <h3 class="card-title text-primary text-uppercase">{{ $item->name }}</h3>-->
                        <!--                                <p class="card-text description mt-3">{{ $item->description }}</p>-->

                        <!--                                <span class="badge badge-primary badge-pill">@money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))</span>-->

                        <!--                                <p class="mt-3 mb-0 text-sm">-->
                        <!--                                    @if($item->available == 1)-->
                        <!--                                    <span class="text-success mr-2">{{ __("AVAILABLE") }}</span>-->
                        <!--                                    @else-->
                        <!--                                    <span class="text-danger mr-2">{{ __("UNAVAILABLE") }}</span>-->
                        <!--                                    @endif-->
                        <!--                                </p>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                        <br/>-->
                        <!--                    </a>-->
                        <!--                </div>-->
                        <!--            @endforeach-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--@endif-->
                        
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
  $("[data-target='#modal-edit-category']").click(function() {
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');


    //$('#cat_id').val(id);
    $('#cat_name').val(name);
    $("#form-edit-category").attr("action", "/categories/"+id);
})
</script>
@endsection
