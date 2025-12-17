@extends('template.mainAdmin')
@section('Title', 'Detail Order')

@section('Content')
<div class="p-12 min-h-screen bg-gray-50">

    {{-- HEADER --}}
    <div class="relative mb-8 flex items-center">
        <a href="{{ route('orders.index') }}"
           class="btn btn-secondary rounded-xl text-sm sm:text-base px-3 sm:px-4">
            <i class="fa-solid fa-backward"></i>
            {{ __('admin.Back')}}
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2 text-lg sm:text-2xl md:text-3xl font-bold text-blue-800">
            {{ __('admin.OrderDetailPage.Title') }}
        </h2>
    </div>

    {{-- MAIN CARD --}}
    <div class="bg-white shadow-lg rounded-2xl p-10 max-w-5xl mx-auto space-y-10">

        {{-- ORDER INFO --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div>
                <p class="text-sm font-semibold text-gray-700">{{__('admin.OrderDetailPage.OrderID')}}</p>
                <p class="text-lg font-bold text-gray-900">
                    #{{ $order->id }}
                </p>
            </div>

            <div>
                <p class="text-sm font-semibold text-gray-700">{{__('admin.OrderDetailPage.Date')}}</p>
                <p class="text-base font-semibold text-gray-900">
                    {{ $order->created_at->format('d M Y H:i') }}
                </p>
            </div>

            <div class="flex flex-col">
                <p class="text-sm font-semibold text-gray-700 mb-2">
                    {{__('admin.OrderDetailPage.Status')}}
                </p>

                <span class="inline-flex items-center justify-center
                             w-fit
                             px-4 py-1.5 rounded-full
                             text-sm font-semibold text-black
                             border border-gray-400
                    @class([
                        'bg-yellow-200' => $order->status === 'waiting_runner',
                        'bg-blue-200' => in_array($order->status, ['accepted','arrived_at_pickup','on_the_way']),
                        'bg-green-200' => $order->status === 'completed',
                        'bg-red-200' => $order->status === 'cancelled',
                    ])">
                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                </span>
            </div>

        </div>

        <hr>

        {{-- USER INFO --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <p class="text-sm font-semibold text-gray-700">{{__('admin.OrderDetailPage.Titiper')}}</p>
                <p class="text-base font-semibold text-gray-900">
                    {{ $order->titiper->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm font-semibold text-gray-700">{{__('admin.OrderDetailPage.Runner')}}</p>
                <p class="text-base font-semibold text-gray-900">
                    {{ $order->runner->name ?? '-' }}
                </p>
            </div>
        </div>

        <hr>

        {{-- LOCATION --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <p class="text-sm font-semibold text-gray-700">{{__('admin.OrderDetailPage.Pickup')}}</p>
                <p class="text-base font-semibold text-gray-900">
                    {{ $order->pickupLocation->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm font-semibold text-gray-700">{{__('admin.OrderDetailPage.Delivery')}}</p>
                <p class="text-base font-semibold text-gray-900">
                    {{ $order->deliveryLocation->name ?? '-' }}
                </p>
            </div>
        </div>

        <hr>

        {{-- ORDER ITEMS --}}
        <div>
            <h3 class="text-lg font-bold text-gray-900 mb-4">
                {{__('admin.OrderDetailPage.Items')}}
            </h3>

            <table class="min-w-full text-sm text-left text-gray-900">
                <thead>
                    <tr class="border-b font-semibold">
                        <th class="py-3 px-4">{{__('admin.OrderDetailPage.Menu')}}</th>
                        <th class="py-3 px-4">{{__('admin.OrderDetailPage.Qty')}}</th>
                        <th class="py-3 px-4">{{__('admin.OrderDetailPage.Price')}}</th>
                        <th class="py-3 px-4">{{__('admin.OrderDetailPage.Total')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr class="border-b">
                        <td class="py-3 px-4 font-medium">
                            {{ $item->menu->name ?? '-' }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $item->quantity }}
                        </td>
                        <td class="py-3 px-4">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-4 font-semibold">
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr>

        {{-- PRICE SUMMARY --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <p class="text-sm font-semibold text-gray-700">{{__('admin.OrderDetailPage.Subtotal')}}</p>
                <p class="text-base font-semibold text-gray-900">
                    Rp {{ number_format($order->subtotal, 0, ',', '.') }}
                </p>
            </div>

            <div>
                <p class="text-sm font-semibold text-gray-700">{{__('admin.OrderDetailPage.Service')}}</p>
                <p class="text-base font-semibold text-gray-900">
                    Rp {{ number_format($order->service_fee, 0, ',', '.') }}
                </p>
            </div>

            <div>
                <p class="text-sm font-semibold text-gray-700">{{__('admin.OrderDetailPage.Total')}}</p>
                <p class="text-xl font-bold text-gray-900">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </p>
            </div>
        </div>

    </div>
</div>
@endsection
