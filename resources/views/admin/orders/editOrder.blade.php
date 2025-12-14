@extends('template.mainAdmin')
@section('Title', 'Update Order')

@section('Content')
@php
    $isFinal = in_array($order->status, ['cancelled', 'completed']);
@endphp

<div class="p-12 min-h-screen bg-gray-50">

    {{-- HEADER --}}
    <div class="relative mb-6 flex items-center">
        <a href="{{ route('orders.index') }}"
           class="bg-pink-500 hover:bg-pink-600
                  text-white px-4 py-2
                  rounded-xl text-sm sm:text-lg
                  inline-flex items-center gap-2
                  shadow-md">
            <i class="fa-solid fa-backward"></i>
            Back
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2
                   text-xl sm:text-2xl md:text-3xl
                   font-bold text-blue-800">
            Update Order Status
        </h2>
    </div>

    {{-- CARD --}}
    <div class="bg-white shadow-lg rounded-2xl p-8 max-w-3xl mx-auto">

        <form action="{{ route('orders.update', $order->id) }}"
              method="POST"
              class="space-y-6">
            @csrf
            @method('PUT')

            {{-- ORDER ID --}}
            <div>
                <p class="text-sm font-semibold text-gray-600">Order ID</p>
                <p class="text-lg font-bold text-gray-900">
                    #{{ $order->id }}
                </p>
            </div>

            {{-- STATUS --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">
                    Status Order
                </label>

                <select name="status"
                    @disabled($isFinal)
                    class="w-full
                        border border-gray-300
                        rounded-lg
                        px-4 py-2.5
                        text-sm
                        transition
                        focus:outline-none
                        focus:ring-2 focus:ring-blue-500
                        focus:border-blue-500
                        {{ $isFinal
                            ? 'bg-gray-100 text-gray-500 cursor-not-allowed'
                            : 'bg-white text-gray-900' }}">

                    <option value="waiting_runner" @selected($order->status === 'waiting_runner')>
                        Waiting Runner
                    </option>
                    <option value="accepted" @selected($order->status === 'accepted')>
                        Accepted
                    </option>
                    <option value="arrived_at_pickup" @selected($order->status === 'arrived_at_pickup')>
                        Arrived at Pickup
                    </option>
                    <option value="completed" @selected($order->status === 'completed')>
                        Completed
                    </option>
                    <option value="cancelled" @selected($order->status === 'cancelled')>
                        Cancelled
                    </option>
                </select>

                @if($isFinal)
                    <p class="text-sm text-gray-500 mt-2">
                        Order dengan status
                        <span class="font-semibold capitalize">
                            {{ $order->status }}
                        </span>
                        tidak dapat diubah.
                    </p>
                @endif
            </div>

            {{-- SUBMIT --}}
            <div class="flex justify-end">
                <button type="submit"
                        @disabled($isFinal)
                        class="px-6 py-2.5
                               rounded-lg
                               font-semibold
                               shadow-md
                               transition
                               {{ $isFinal
                                    ? 'bg-gray-400 text-white cursor-not-allowed'
                                    : 'bg-blue-600 hover:bg-blue-700 text-white' }}">
                    Update Status
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
