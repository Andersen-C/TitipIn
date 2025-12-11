@extends('template.mainAdmin')
@section('Title', 'Dashboard')

@section('Content')
<div class="p-12 min-h-screen">
    <h1 class="text-3xl font-bold mb-4 text-blue-700">Hi, Admin</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 w-full">

        {{-- Total User Card --}}
        <div class="p-3 sm:p-4 bg-white shadow-lg hover:shadow-xl duration-200 rounded-2xl border border-gray-100 flex flex-col sm:flex-row items-center sm:items-start gap-3">
            <div class="p-3 bg-blue-700 text-white rounded-xl">
                <i class="fa-solid fa-user text-xl sm:text-2xl"></i>
            </div>
            <div class="text-center sm:text-left">
                <p class="text-gray-500 font-medium text-sm sm:text-base">Total User</p>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $users }}</h1>
            </div>
        </div>

        {{-- Total Active Runner Card --}}
        <div class="p-3 sm:p-4 bg-white shadow-lg hover:shadow-xl duration-200 rounded-2xl border border-gray-100 flex flex-col sm:flex-row items-center sm:items-start gap-3">
            <div class="p-3 bg-blue-700 text-white rounded-xl ">
                <i class="fa-solid fa-user text-xl sm:text-2xl"></i>
            </div>
            <div class="text-center sm:text-left">
                <p class="text-gray-500 font-medium text-sm sm:text-base">Total Active Runner</p>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $activeRunner }}</h1>
            </div>
        </div>

        {{-- Total Menu Card --}}
        <div class="p-3 sm:p-4 bg-white shadow-lg hover:shadow-xl duration-200 rounded-2xl border border-gray-100 flex flex-col sm:flex-row items-center sm:items-start gap-3">
            <div class="p-3 bg-blue-700 text-white rounded-xl">
                <i class="fa-solid fa-utensils text-xl sm:text-2xl"></i>
            </div>
            <div class="text-center sm:text-left">
                <p class="text-gray-500 font-medium text-sm sm:text-base">Total Menu</p>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $menus }}</h1>
            </div>
        </div>

        {{-- Total Order Card --}}
        <div class="p-3 sm:p-4 bg-white shadow-lg hover:shadow-xl duration-200 rounded-2xl border border-gray-100 flex flex-col sm:flex-row items-center sm:items-start gap-3">
            <div class="p-3 bg-blue-700 text-white rounded-xl">
                <i class="fa-solid fa-cart-shopping text-xl sm:text-2xl"></i>
            </div>
            <div class="text-center sm:text-left">
                <p class="text-gray-500 font-medium text-sm sm:text-base">Total Pesanan</p>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $orders }}</h1>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-5">
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-xl transition duration-200 h-full">
            <h2 class="text-xl sm:text-2xl font-bold mb-2 text-gray-700">Jumlah Biaya Order Selama 7 Hari Terakhir</h2>
            <div class="w-full h-64 sm:h-80 md:h-96">
                <canvas id="TotalOrderPrice"></canvas>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow hover:shadow-xl transition duration-200  h-full">
            <h2 class="text-xl sm:text-2xl font-bold mb-2 text-gray-700">Jumlah Orderan Selama 7 Hari Terakhir</h2>
            <div class="w-full h-64 sm:h-80 md:h-96">
                <canvas id="OrderAmount"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-5 ">
        {{-- Tabel Kiri  --}}
        <div class="overflow-x-auto p-4 bg-white rounded-xl hover:shadow-xl transition duration-200">
            <h2 class="text-xl sm:text-2xl font-bold mb-2 text-gray-700 flex item-center gap-2">
                <i class="fa-solid fa-trophy text-yellow-500"></i>
                Runner Leaderboard
            </h2>
            <table class="table w-full border-collapse text-sm sm:text-base">
                <thead class="text-black border-b-2 border-gray-600">
                    <tr>
                        <th class="whitespace-nowrap">Rank</th>
                        <th class="whitespace-nowrap">Nama</th>
                        <th class="whitespace-nowrap">Total Order</th>
                    </tr>
                </thead>
                <tbody class="text-black">
                @foreach ($topThreeRunner as $key => $runner)
                    <tr class="border-b-2 border-black last:border-b-0">
                        <th>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($key == 0) bg-yellow-300 text-yellow-800
                                    @elseif($key == 1) bg-gray-300 text-gray-800
                                    @else bg-amber-800 text-white
                                    @endif">
                                {{$key + 1}}
                            </span>
                        </th>
                        <td class="whitespace-nowrap">{{ $runner->runner->name }}</td>
                        <td class="whitespace-nowrap">{{ $runner->total_orders }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- tabel kanan --}}
        <div class="overflow-x-auto p-4 bg-white rounded-xl hover:shadow-xl transition duration-200">
            <h2 class="text-xl sm:text-2xl font-bold mb-2 text-gray-700">
                <i class="fa-solid fa-bowl-food text-yellow-500"></i>
                Menu Leaderboard
            </h2>
            <table class="table w-full border-collapse text-sm sm:text-base">
                <!-- head -->
                <thead class="text-black border-b-2 border-gray-600">
                    <tr>
                        <th class="whitespace-nowrap">Rank</th>
                        <th class="whitespace-nowrap">Nama</th>
                        <th class="whitespace-nowrap">Jumlah Terjual</th>
                        <th class="whitespace-nowrap">Location</th>
                    </tr>
                </thead>
                <tbody class="text-black">
                @foreach ($topThreeMenu as $key => $item)
                    <tr class="border-b-2 border-black last:border-b-0">
                        <th>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($key == 0) bg-yellow-300 text-yellow-800
                                    @elseif($key == 1) bg-gray-300 text-gray-800
                                    @else bg-amber-800 text-white
                                    @endif">
                                {{$key + 1}}
                            </span>
                        </th>
                        <td class="whitespace-nowrap">{{ $item->menu->name }}</td>
                        <td class="whitespace-nowrap">{{ $item->total_sold }}</td>
                        <td class="whitespace-nowrap">{{ $item->menu->location->name ?? 'Unknown' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
new Chart(document.getElementById('TotalOrderPrice'), {
    type: 'bar',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Order Revenue (Last 7 Days)',
            data: @json($orderTotals),
            borderWidth: 2,
            backgroundColor: 'rgba(54, 162, 235, 0.4)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderRadius: 5,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: value => 'Rp ' + value.toLocaleString(),
                }
            }
        }
    }
});

new Chart(document.getElementById('OrderAmount'), {
    type: 'line',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Order Amount (Last 7 Days)',
            data: @json($orderAmountTotal),
            borderWidth: 2,
            backgroundColor: 'rgba(54, 162, 235, 0.4)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderRadius: 5,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: value => value.toLocaleString(),
                }
            }
        }
    }
});
</script>
@endsection