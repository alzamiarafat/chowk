<thead class="thead-light">
    <tr>
        <th scope="col">{{ __('ID') }}</th>
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('driver'))
            <th scope="col">{{ __('Actions') }}</th>
        @endif

        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('driver'))
        <th class="table-web" scope="col">{{ __('Client') }}</th>
        @endif
        <th scope="col">{{ __('Current status') }}</th>
        <th class="table-web" scope="col">{{ __('Schedule Time') }}</th>
        <th class="table-web" scope="col">{{ __('Order Time') }}</th>
        <th class="table-web" scope="col">{{ __('Price') }}</th>
        <th class="table-web" scope="col">{{ __('Delivery') }}</th>
        @if(auth()->user()->hasRole('admin')||auth()->user()->hasRole('driver'))
        <th class="table-web" scope="col">{{ __('Address') }}</th>
        @endif
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner'))
        <th class="table-web" scope="col">{{ __('Driver') }}</th>
        @endif


    </tr>
</thead>
<tbody>
@foreach($orders as $order)
    <tr>
        <td>
            <a class="btn badge badge-success badge-pill" href="{{ route('orders.show',$order->id )}}">#{{ $order->id }}</a>
        </td>
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('driver'))
            @include('orders.partials.actions.table',['order' => $order ])
        @endif

        {{--@hasrole('admin|owner|driver')--}}
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('driver'))
            <td class="table-web">
                {{ $order->client->name }}
            </td>
        @endif

        <td>
            @include('orders.partials.laststatus')
        </td>
        <td class="table-web">
            {{ $order->time_formated }}
        </td>
        <td class="table-web">
            {{ $order->created_at->format(config('settings.datetime_display_format')) }}
        </td>
        <td class="table-web">
            @money( $order->order_price, config('settings.cashier_currency'),config('settings.do_convertion'))
        </td>
        <td class="table-web">
            @money( $order->delivery_price, config('settings.cashier_currency'),config('settings.do_convertion'))
        </td>

        @if(auth()->user()->hasRole('admin')||auth()->user()->hasRole('driver'))
            <td class="table-web">
                {{ $order->address?$order->address->address:"" }}
            </td>
        @endif
        @hasrole('admin|owner')
        {{--@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner'))--}}
            <td class="table-web">
                {{ !empty($order->driver->name) ? $order->driver->name : "" }}
            </td>
        @endif

    </tr>
@endforeach
</tbody>


