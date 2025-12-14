@extends('template.mainAdmin')
@section('Title', 'Manage Orders')

@section('Content')
<div class="p-12 min-h-screen bg-gray-50">

    {{-- HEADER --}}
    <div class="relative mb-6 flex items-center">
        <a href="{{ route('admin.manage') }}"
           class="btn btn-secondary rounded-xl text-sm sm:text-lg z-10 inline-flex items-center gap-2">
            <i class="fa-solid fa-backward"></i>
            Back
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2
                   text-xl sm:text-2xl md:text-3xl font-bold text-blue-800">
            Manage Orders
        </h2>
    </div>

    <div class="bg-white shadow-lg rounded-2xl p-6 overflow-x-auto">

        <table class="min-w-full text-sm text-left text-gray-900">
            <thead>
                <tr class="font-semibold text-gray-900 border-b border-gray-300">
                    <th class="py-4 px-4">No.</th>
                    <th class="py-4 px-4">Titiper</th>
                    <th class="py-4 px-4">Runner</th>
                    <th class="py-4 px-4">Status</th>
                    <th class="py-4 px-4">Total</th>
                    <th class="py-4 px-4">Tanggal</th>
                    <th class="py-4 px-4 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $index => $order)
                <tr class="hover:bg-gray-50 border-b border-gray-200">

                    <td class="py-4 px-4 font-semibold">
                        {{ $index + 1 }}
                    </td>

                    <td class="py-4 px-4 font-medium">
                        {{ $order->titiper->name ?? '-' }}
                    </td>

                    <td class="py-4 px-4">
                        {{ $order->runner->name ?? '-' }}
                    </td>

                    <td class="py-4 px-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @class([
                                'bg-yellow-100 text-yellow-700' => $order->status === 'waiting_runner',
                                'bg-blue-100 text-blue-700' => in_array($order->status, ['accepted','arrived_at_pickup','on_the_way']),
                                'bg-green-100 text-green-700' => $order->status === 'completed',
                                'bg-red-100 text-red-700' => $order->status === 'cancelled',
                            ])">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </td>

                    <td class="py-4 px-4 font-semibold">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>

                    <td class="py-4 px-4">
                        {{ $order->created_at->format('d M Y') }}
                    </td>

                    {{-- ACTIONS (CRUD) --}}
                    <td class="py-4 px-4 text-center space-x-2">

                        {{-- DETAIL --}}
                        <a href="{{ route('orders.show', $order->id) }}"
                           class="bg-blue-600 hover:bg-blue-700
                                  text-white
                                  border-2 border-black
                                  shadow-md
                                  px-4 py-1.5
                                  rounded-lg
                                  text-sm
                                  inline-flex items-center gap-1">
                            <i class="fa-solid fa-circle-info"></i>
                            Details
                        </a>

                        {{-- UPDATE --}}
                        <button
                            class="bg-yellow-500 hover:bg-yellow-600
                                   text-white
                                   border-2 border-black
                                   shadow-md
                                   px-4 py-1.5
                                   rounded-lg
                                   text-sm
                                   inline-flex items-center gap-1"
                            onclick="alert('Update status (admin only)')">
                            <i class="fa-solid fa-pen"></i>
                            Update
                        </button>

                        {{-- DELETE --}}
                        <button
                            class="bg-red-600 hover:bg-red-700
                                   text-white
                                   border-2 border-black
                                   shadow-md
                                   px-4 py-1.5
                                   rounded-lg
                                   text-sm
                                   inline-flex items-center gap-1"
                            onclick="alert('Order tidak dapat dihapus (business rule)')">
                            <i class="fa-solid fa-trash"></i>
                            Delete
                        </button>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
