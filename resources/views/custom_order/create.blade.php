@extends('layouts.app', ['title' => __('Order Management')])

@section('content')
    @include('custom_order.partials.header', ['title' => __('Custom Order Management')])
    @include('restorants.partials.modals')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 ">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Create Order') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add New Customer</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{--<div class="row">--}}
                            {{--Custome order Left Side Items--}}
                        <div class="container">
                        <form method="post" action="" autocomplete="off">
                            @csrf
                            {{--1st row--}}
                            <div class="row">
                                <div class="col-md-4 form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    {{--<label class="col-sm-2 form-control-label" for="input-phone">{{ __('Phone :') }}</label>--}}
                                        <select class="mdb-select "  id="mobile" name="mobile" onchange="getUser()" searchable="Search here..">
                                            <option value="" disabled selected>Search and Choose Phone</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id}}">{{ $user->phone }}</option>
                                            @endforeach
                                        </select>
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    {{--<label class="col-sm-2 form-control-label" for="input-name">{{ __('Name :') }}</label>--}}
                                        <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }} " required >

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    {{--<label class="col-sm-2 form-control-label" for="input-email">{{ __('Email :') }}</label>--}}
                                        <input type="email" name="email" id="email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--2nd row--}}
                            <div class="row">
                                <div class="col-sm-6 form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                    {{--<label class="col-sm-2 form-control-label" for="input-email">{{ __('Address :') }}</label>--}}
                                        <input type="text" name="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Address') }}" value="{{ old('address') }}" required>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-sm-6 form-group{{ $errors->has('order_type') ? ' has-danger' : '' }}">
                                    {{--<label class="col-sm-2 form-control-label" for="input-order_type">{{ __('Order type :') }}</label>--}}
                                    <div class="col-sm-12">
                                        <input type="radio" name="order_type" value="0" checked> On demand
                                        <input type="radio" name="order_type" value="1"> Scheduling
                                    </div>

                                    @if ($errors->has('order_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('order_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--3rd row--}}
                            <div class="row">
                                <div class="col-sm-6 form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                    {{--<label class="col-sm-2 form-control-label" for="input-category">{{ __('Category :') }}</label>--}}
                                    {{--<div class="col-sm-6">--}}
                                        <select class="mdb-select md-form" searchable="Search here.." id="restaurant" onchange="getProduct()">
                                            <option value="" disabled selected>Search and Choose Category</option>
                                            @foreach($restaurants as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach

                                        </select>
                                </div>
                                <div class="col-sm-6 form-group{{ $errors->has('products') ? ' has-danger' : '' }}">
                                    {{--<label class="col-sm-2 form-control-label" for="input-category">{{ __('Product :') }}</label>--}}
                                    <div class="col-sm-6">

                                        <select class="mdb-select md-form" id="product" onchange="getItem(this.value)" searchable="Search here.." >
                                            <option value=""  disabled selected>Search and Select Products</option>
                                            {{--<option value="{{  }}"> {{  }}</option>--}}
                                        </select>
                                    </div>
                                </div>
                            </div>

                            
                            <table id="table"border="1">
                                <tr>
                                    <td>SL#</td>
                                    <td>Name</td>
                                    <td>Image</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                    <td>Total</td>
                                    <td>Action</td>
                                </tr>

                            </table>


                                <div class="row form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
                                    <label class="col-sm-2 form-control-label" for="input-comment">{{ __('Comment :') }}</label>
                                    <div class="col-sm-6">
                                        <textarea name="comment" id="" rows="3" class="form-control form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}" ></textarea>
                                        @if ($errors->has('comment'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                        </form>
                    </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div></p></a></span>

    {{--<script>
        $(document).ready(function() {
            $('.mdb-select').materialSelect();
        });
    </script>--}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                </div>

                <div class="container">
                    <form method="post" action="{{ route('clients.store') }}" autocomplete="off">
                        @csrf
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-phone">{{ __('Phone') }}</label>
                                <input type="text" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('phone') }}" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>


                <{{--div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>--}}
            </div>
        </div>
    </div>

    {{--<script>--}}
        {{--function showProducts() {--}}
            {{--$('#exampleModal').modal('show');--}}

{{--//--}}
            {{--<!-- Button trigger modal -->--}}
{{--//            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
{{--//                Launch demo modal--}}
{{--//            </button>--}}
        {{--}--}}
    {{--</script>--}}
{{--Products Modal--}}
    <!-- Button to Open the Modal -->


    {{--Product Modal End--}}
    <script>

        function getItem(id) {
            axios.get('/getItem/'+id).then(function (response) {
                console.log(response.data.data.name);

                cartTotal.items =response.data.data;

                var table = document.getElementById("table");
                var row = table.insertRow(1);
                var col1 = row.insertCell(0);
                var col2 = row.insertCell(1);
                var col3 = row.insertCell(1);
                var col4 = row.insertCell(1);
                var col5 = row.insertCell(1);
                var col6 = row.insertCell(1);
                var col7 = row.insertCell(1);

                col1.innerHTML = response.data.data.id;
                col2.innerHTML = '<p class="btn btn-danger">Remove</p>';
                col3.innerHTML = '<input id="total" type="text"/>';
                col4.innerHTML = response.data.data.price;
                col5.innerHTML = '<p class="btn">-</p><input type="text" value="1"/><p class="btn" onclick="increInter(response.data.data.id)">+</p>';
                col6.innerHTML = '<img src="'+response.data.data.image+'" alt="image"' > ;
                col7.innerHTML = response.data.data.name;
            }).catch(function (error) {
                console.log(error);
            });

            /* $.ajax({
                 type:'GET',
                 url:'/getItem',
                 'data': {id: id},
                 success:function(data) {
                     var reslt = [data.data];
                     /!*var i =0;
                     var price = data.data.price;*!/

                     /!*for(i; i<reslt.length; i++){

                         $('#table').append(
                             $('<tr></tr>').append(
                                 $('<td></td>').html(reslt[i].id),
                                 $('<td></td>').html(reslt[i].name),
                                 $('<td></td>').html('<img src="'+reslt[i].image+'" alt="" width="50" height="60">'),
                                 $('<td></td>').html('<p class="btn btn-primary" onclick="reslt[i].id">-</p><input id="qty" class="prc" type="text" value="1"/><p class="btn btn-primary" onclick="increInter('+reslt[i].id+')">+</p>'),
                                 $('<td></td>').html(reslt[i].price),
                                 $('<td></td>').html('<input id="total" value="'+reslt[i].price*1+'"/>'),
                                 $('<td></td>').html('<a class="btn btn-danger">Remove</a>')

                             )
                         );

                         /!*   $('.quantity').on('input','prc',function () {
                                var totalSum = 0;
                                $('.quantity .prc').each(function () {
                                    var inputVal = $(this).val();
                                    if ($.isNumeric(inputVal)){
                                        totalSum += inputVal;
                                    }

                                });
                                $('#total').text(totalSum);
                                console.log(totalSum);
                            })*!/

                         /!* var table = document.getElementById("table");
                          var row = table.insertRow(1);
                          var col1 = row.insertCell(0);
                          var col2 = row.insertCell(1);
                          var col3 = row.insertCell(1);
                          var col4 = row.insertCell(1);
                          var col5 = row.insertCell(1);
                          var col6 = row.insertCell(1);
                          var col7 = row.insertCell(1);

                          col1.innerHTML = reslt[i].id;
                          col2.innerHTML = "Remove";
                          col3.innerHTML = reslt[i].name;
                          col4.innerHTML = reslt[i].name;
                          col5.innerHTML = reslt[i].name;
                          col6.innerHTML = reslt[i].name;
                          col7.innerHTML = "Remove";
         *!/


                     }*!/




                     //console.log(data.data.name);

                 }
             });
             $('#qty').keyup(function() {
                 alert(document.getElementById('qty').value+price);

             });
         */



        }


        function decreInter(product_id) {
            var decre = document.getElementById("qty").value - 1;
            document.getElementById("qty").value = decre;

            axios.get('/cartinc/'+product_id).then(function (response) {
                getCartContentAndTotalPrice();
            }).catch(function (error) {
                console.log(error);
            });

        }

        function increInter(product_id) {

            alert(product_id)

            /*
                $.ajax({
                    type:'GET',
                    url:'/getItem',
                    'data': {id: product_id},
                    success:function(data) {
                        var incre = document.getElementById("qty").value - (-1);
                        document.getElementById("qty").value = incre;
                        document.getElementById("total").value = incre*data.data.price;
                        getItem(data.data.id);
                        console.log(price);
                        console.log(data.data);

                    }
                });*/

        }

        function getProduct() {

            var id = document.getElementById("restaurant").value;
            $.ajax({
                type:'GET',
                url:'/getProduct',
                'data': {id: id},
                success:function(data) {
                    var product = document.getElementById("product"),
                        arr = data;
                    for (var i = 0; i < data.length; i++) {
                        var option = document.createElement("OPTION"),
                            txt = document.createTextNode(data[i].name);
                        option.appendChild(txt);
                        option.setAttribute("value", data[i].id);
                        product.insertBefore(option,product.lastChild);
                    }
                }
            });

        }




       








    </script>


    <script>

        {{--function getProduct() {--}}
            {{--$('mobile').on('change', '.category_id', function () {--}}
                {{--var category_id = $(this).val();--}}
                {{--$.ajax({--}}
                    {{--type: 'get',--}}
                    {{--url: '{{url('get_product_by_category')}}',--}}
                    {{--data: {category_id: category_id},--}}
                    {{--context: this,--}}
                    {{--success: function (data) {--}}
                        {{--$(this).parents('tr').find('.item_id').html(data);--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
        {{--}--}}
//        Added by Mehrab
        $(function () {
            $('#phone').autocomplete({
                source:function (request,response) {
                    consol.log(request.term)
                    $.getJSON('{{url('custom/order/customers')}}',function (data) {
                        var array = $.map(data,function(row) {
                            return {
                                value:row.id,
                                label:row.phone,
                                /*name:row.name,
                                email:row.email,*/
                            }
                        })
                        response($.ui.autocomplete.filter(array,request.term));
                    })
                },
                minLength:1,
                dealy:500,
                select:function(event,ui){
                    console.log(ui.item)
                    $('#name').val(ui.item.name)
                    $('#email').val(ui.item.email)
                }
            })

        })
        


    </script>

@endsection
