<div class="card shadow">
    {{--Mehraab changed updated--}}
    <div class="card-header border-0">
        @if(count($orders))
        <form method="GET">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">{{ __('Orders') }}</h3>
                </div>
                <div class="col-4 text-right">
                    <button id="show-hide-filters" class="btn btn-icon btn-1 btn-sm btn-outline-secondary" type="button">
                        <span class="btn-inner--icon"><i id="button-filters" class="ni ni-bold-down"></i></span>
                    </button>
                </div>
            </div>
                <div class="tab-content orders-filters">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-daterange datepicker row align-items-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('Date From') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="fromDate" class="form-control" placeholder="{{ __('Date from') }}" type="text" <?php if(isset($_GET['fromDate'])){echo 'value="'.$_GET['fromDate'].'"';} ?> >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('Date to') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="toDate" class="form-control" placeholder="{{ __('Date to') }}" type="text"  <?php if(isset($_GET['toDate'])){echo 'value="'.$_GET['toDate'].'"';} ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @hasrole('admin|driver')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="restorant">{{ __('Filter by Restaurant') }}</label>
                                    <select class="form-control select2" name="restorant_id">
                                        <option disabled selected value>  {{ __('Select an option') }}  </option>
                                        @foreach ($restorants as $restorant)
                                            <option <?php if(isset($_GET['restorant_id'])&&$_GET['restorant_id'].""==$restorant->id.""){echo "selected";} ?> value="{{ $restorant->id }}">{{$restorant->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        @endif
                        @if (config('app.isft'))
                        @hasrole('admin|owner')
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="client">{{ __('Filter by Client') }}</label>

                                <select class="form-control select2" id="blabla" name="client_id">
                                    <option disabled selected value>  {{ __('Select an option') }} </option>
                                    @foreach ($clients as $client)
                                        <option  <?php if(isset($_GET['client_id'])&&$_GET['client_id'].""==$client->id.""){echo "selected";} ?>  value="{{ $client->id }}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        @hasrole('admin|owner')
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="driver">{{ __('Filter by Driver') }}</label>
                                <select class="form-control select2" name="driver_id">
                                    <option disabled selected value> {{ __('Select an option') }} </option>
                                    @foreach ($drivers as $driver)
                                        <option <?php if(isset($_GET['driver_id'])&&$_GET['driver_id'].""==$driver->id.""){echo "selected";} ?>   value="{{ $driver->id }}">{{$driver->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        </div>
                        @endif    
                        @else
                        @endif

                        <div class="col-md-12 offset-md-12">
                            <div class="row">
                                @if ($parameters)
                                    <div class="col-md-4">
                                        <a href="{{ Request::url() }}" class="btn btn-md btn-block">{{ __('Clear Filters') }}</a>
                                    </div>
                                    <div class="col-md-4">
                                    <a href="{{Request::fullUrl()."&report=true" }}" class="btn btn-md btn-success btn-block">{{ __('Download report') }}</a>
                                    </div>
                                @else
                                    <div class="col-md-8"></div>
                                @endif

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-md btn-block">{{ __('Filter') }}</button>
                                </div>
                        </div>
                    </div>
             </div>
        </form>
        @endif

            <div class="col-md-3">
                {{--<button type="submit" class="btn btn-success btn-md btn-block">{{ __('Create Custom Order') }}</button>--}}
                {{--<a class="btn btn-success" href="{{route('customorder')}}"><i class="fa fa-plus"></i>{{ __(' Create Custom Order') }}</a>--}}
            </div>

    </div>
    <div class="col-12">
        @include('partials.flash')
    </div>
    @if(count($orders))
    <div class="table-responsive">
        <table class="table align-items-center">
            @if (isset($financialReport))
                @include('finances.financialdisplay')
            @elseif (config('app.isqrsaas'))
                @include('orders.partials.orderdisplay_local')
            @else
                @include('orders.partials.orderdisplay')
            @endif
        </table>
    </div>
    @endif
    <div class="card-footer py-4">
        @if(count($orders))
        <nav class="d-flex justify-content-end" aria-label="...">
            {{ $orders->appends(Request::all())->links() }}
        </nav>
        @else
            <h4>{{ __('You don`t have any orders') }} ...</h4>
        @endif
    </div>
</div>