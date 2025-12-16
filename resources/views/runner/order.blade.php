@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'Order')

@section('Content')

<div class="py-8 px-4 max-w-7xl mx-auto">
    
    {{-- Menampilkan Pesan Sukses/Error --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class='items-center'>
        <h1 class="text-3xl sm:flex sm:flex-row font-bold text-blue-900 mb-6">{{ __('runner.Orders') }}</h1>
        
        @forelse($orders as $order)
        <div class='container mb-4'>

            <div class="flex flex-col p-4 border-2 border-zinc-500 rounded-lg sm:flex-row bg-white relative">
                
                {{-- GAMBAR --}}
                <div class="flex flex-col sm:justify-center w-full sm:w-1/4 sm:h-max">
                    <img class="justify-center rounded-md object-cover h-32 w-full" src="https://picsum.photos/200/100?random={{ $order->id }}" alt="Menu Image">
                </div>
                
                {{-- INFO PESANAN --}}
                <div class="flex flex-col sm:w-1/2 ml-0 p-6">
                    
                    {{-- NAMA MENU (GROUPING) --}}
                    <h3 class="text-black font-bold text-xl">
                        @php
                            $groupedItems = $order->orderItems->groupBy(function($item) {
                                return $item->menu->name ?? $item->name ?? __('runner.Unknown');
                            });
                        @endphp

                        @foreach($groupedItems as $name => $items)
                            <span class="block sm:inline">
                                {{ $items->count() }}x {{ $name }}
                            </span>
                            @if(!$loop->last), @endif
                        @endforeach
                    </h3>
                
                    {{-- HARGA --}}
                    <p class="text-black text-lg">
                        Rp. {{ number_format($order->total_price, 0, ',', '.') }}
                    </p>
                    
                    {{-- LOKASI --}}
                    <p class="text-gray-600 mt-4 sm:mt-auto">
                        <span class="font-semibold">{{ $order->pickupLocation->name ?? __('runner.Pickup') }}</span> 
                        &rarr; 
                        <span class="font-semibold">{{ $order->deliveryLocation->name ?? __('runner.Delivery') }}</span>
                    </p>
                </div>
                
                {{-- BAGIAN KANAN (STATUS & TOMBOL) --}}
                <div class="flex flex-col sm:w-1/4 justify-between sm:items-end w-full">
                        
                    {{-- BADGE STATUS --}}
                    <div class="flex flex-row mb-2 justify-end w-full">
                        @if($order->runner_id == null)
                            <div class="flex flex-col px-3 border-2 text-white font-semibold border-blue-500 bg-blue-500 rounded-md">
                                <h2>{{__('runner.newOrder')}}</h2>
                            </div>
                        @elseif($order->runner_id == Auth::id())
                            {{-- LOGIKA 1: GANTI STATUS JADI PENDING (KUNING) --}}
                            <div class="flex flex-col px-3 border-2 text-yellow-600 font-semibold border-yellow-400 bg-yellow-100 rounded-md">
                                <h2 class="flex items-center gap-1">
                                    {{-- Icon Jam Kecil --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ __('runner.Pending') }}
                                </h2>
                            </div>
                        @endif
                    </div>
                    
                    {{-- TOMBOL AKSI --}}
                    <div class="flex flex-row items-end w-full justify-between sm:justify-end gap-2">
                        <div class="flex flex-col">
                            @if($order->runner_id == null)
                                
                                {{-- LOGIKA 2: TOMBOL TERIMA DIAKTIFKAN KEMBALI --}}
                                <form action="{{ route('runner.orders.accept', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-white text-blue-600 hover:bg-blue-50 border border-blue-600 rounded-lg px-4 py-1 font-bold text-lg transition duration-200">
                                        {{ __('runner.Accept') }}
                                    </button>
                                </form>

                            @else
                                <span class="text-gray-400 px-2 py-1 font-semibold text-sm italic">{{__('admin.YourOrder')}}</span>
                            @endif
                        </div>

                        <div class="flex flex-col justify-end">
                            <a href="{{ route('runner.orders.show', $order->id) }}" class="text-blue-600 hover:text-white hover:bg-blue-600 border border-blue-600 transition-colors duration-200 font-semibold rounded-lg px-4 py-2 text-sm">
                                {{ __('runner.Detail') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="text-center py-10 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300">
                <p class="text-xl text-gray-500 font-semibold">{{ __('runner.NoOrder') }}</p>
            </div>
        @endforelse

    </div>   
</div>

@endsection