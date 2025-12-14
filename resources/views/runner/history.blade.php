@extends('template.afterLogin.RunnerAfterLogin')
@section('Title', 'History')

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

    <div class='items-center '>
        <h1 class="text-3xl sm:flex sm:flex-row font-bold text-blue-900 mb-6">History</h1>
        
        @forelse($orders as $order)
        <div class='container mb-4'>

            <div class="flex flex-col p-4 border-2 border-zinc-500 rounded-lg sm:flex-row bg-white relative">
                
                <div class="flex flex-col sm:justify-center w-full sm:w-1/4 sm:h-max">
                    <img class="justify-center rounded-md object-cover h-32 w-full" src="https://picsum.photos/200/100?random={{ $order->id }}" alt="Menu Image">
                </div>
                
                <div class="flex flex-col sm:w-1/2 ml-0 p-6">
                    
                    <h3 class="text-black font-bold text-xl">
                        @php
                            $groupedItems = $order->orderItems->groupBy(function($item) {
                                return $item->menu->name ?? $item->name ?? 'Unknown';
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
                        <span class="font-semibold">{{ $order->pickupLocation->name ?? 'Lokasi Awal' }}</span> 
                        &rarr; 
                        <span class="font-semibold">{{ $order->deliveryLocation->name ?? 'Lokasi Tujuan' }}</span>
                    </p>
                </div>
                
                <div class="flex flex-col sm:w-1/4 justify-between sm:items-end w-full">
                        
                    
                    <div class="flex flex-row items-end w-full justify-between sm:justify-end gap-2">
                        <div class="flex flex-col">
                            @if($order->runner_id == null)
                                
                                <form action="{{ route('runner.orders.accept', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-600 text-white  rounded-lg px-4 py-1 font-bold text-lg transition duration-200">
                                        Selesai
                                    </button>
                                </form>

                            @else
                                <span class="text-gray-400 px-2 py-1 font-semibold text-sm italic">Ongoing</span>
                            @endif
                        </div>

                        <div class="flex flex-col justify-end">
                            <a href="{{ route('runner.history.show', $order->id) }}" class='text-blue-800 hover:bg-blue-900 hover:text-white transition duration-200 font-semibold border-2 border-blue-800 rounded-md px-3 py-1'>
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="text-center py-10 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300">
                <p class="text-xl text-gray-500 font-semibold">Belum ada history tersedia.</p>
            </div>
        @endforelse

    </div>   
</div>

@endsection