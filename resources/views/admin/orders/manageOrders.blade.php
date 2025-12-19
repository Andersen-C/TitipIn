@extends('template.mainAdmin')
@section('Title','Manage Orders')

@section('Content')
<div class="p-12 min-h-screen">

    {{-- HEADER --}}
    <div class="relative flex items-center mb-4 gap-2">
        <a href="{{ route('admin.manage') }}"
           class="btn btn-secondary rounded-xl text-sm sm:text-base px-3 sm:px-4">
            <i class="fa-solid fa-backward"></i>
            {{ __('admin.Back')}}
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2 text-lg sm:text-2xl md:text-3xl font-bold text-blue-800">
            {{ __('admin.OrderTable.Title') }}
        </h2>
    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-3xl shadow-xl p-8 overflow-x-auto">

        <table class="min-w-full text-sm text-black">
            <thead>
                <tr class="text-left text-black">
                    <th class="text-l">{{ __('admin.OrderTable.No') }}</th>
                    <th class="text-l">{{ __('admin.OrderTable.Titiper') }}</th>
                    <th class="text-l">{{ __('admin.OrderTable.Runner') }}</th>
                    <th class="text-l">{{ __('admin.OrderTable.Status') }}</th>
                    <th class="text-l">{{ __('admin.OrderTable.Total') }}</th>
                    <th class="text-l">{{ __('admin.OrderTable.Date') }}</th>
                    <th class="text-l text-center">{{ __('admin.OrderTable.Action') }}</th>
                </tr>
            </thead>

            <tbody>
            @foreach($orders as $order)
                <tr class="hover:bg-gray-50 transition">

                    {{-- NO --}}
                    <td class="py-5 px-4 font-semibold">
                    {{ $orders->firstItem() + $loop->index }}
                </td>

                    <td class="py-5 px-4 font-semibold">
                        {{ $order->titiper->name ?? '-' }}
                    </td>

                    <td class="py-5 px-4">
                        {{ $order->runner->name ?? __('admin.OrderTable.None') }}
                    </td>

                    {{-- STATUS --}}
                    <td class="py-5 px-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @class([
                                'bg-yellow-100 text-yellow-700' => $order->status === 'waiting_runner',
                                'bg-blue-100 text-blue-700' => in_array($order->status, ['accepted','arrived_at_pickup','on_the_way']),
                                'bg-green-100 text-green-700' => $order->status === 'completed',
                                'bg-red-100 text-red-700' => $order->status === 'cancelled',
                            ])">
                            {{ ucfirst(str_replace('_',' ',$order->status)) }}
                        </span>
                    </td>

                    <td class="py-5 px-4 font-semibold">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>

                    <td class="py-5 px-4 text-gray-600">
                        {{ $order->created_at->format('d M Y') }}
                    </td>

                    {{-- ACTION --}}
                    <td class="py-5 px-4 text-center space-x-2">

                        {{-- DETAIL --}}
                        <a href="{{ route('orders.show', $order->id) }}"
                           class="btn btn-l mb-2 bg-blue-800 hover:bg-blue-900 hover:text-white">
                            <i class="fa-solid fa-circle-info"></i>
                            {{ __('admin.Details') }}
                        </a>

                        {{-- UPDATE --}}
                        <a href="{{ route('orders.edit', $order->id) }}"
                           class="btn btn-l mb-2 bg-amber-500 hover:bg-amber-700 hover:text-white">
                            <i class="fa-solid fa-pen"></i>
                            {{ __('admin.Update') }}
                        </a>

                        {{-- DELETE --}}
                        <button
                            onclick="openDeleteModal({{ $order->id }})"
                            class="btn btn-l mb-2 bg-red-500 hover:bg-red-700 hover:text-white">
                            <i class="fa-solid fa-trash"></i>
                            {{ __('admin.Delete') }}
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-8 ml-4 mr-4 mb-4">
            {{ $orders->links() }}
        </div>

    </div>
</div>

{{-- DELETE MODAL --}}
<div id="deleteModal"
     class="fixed inset-0 hidden z-50
            flex items-center justify-center
            bg-black/40 backdrop-blur-sm">

    <div class="absolute inset-0" onclick="closeDeleteModal()"></div>

    <div class="relative bg-white rounded-2xl shadow-xl
                w-full max-w-md p-6 z-10">

        <div class="flex items-center gap-3 mb-4">
            <i class="fa-solid fa-triangle-exclamation text-red-600 text-2xl"></i>
            <h3 class="text-xl font-bold text-red-600">
                {{ __('admin.OrderDeleteModal.Title') }}
            </h3>
        </div>

        <p class="text-gray-700 mb-6">
            {{ __('admin.OrderDeleteModal.Message') }}
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()"
                    class="px-5 py-2 rounded-lg
                           border border-gray-300 cursor-pointer
                           text-gray-700 hover:bg-gray-100">
                {{ __('admin.OrderDeleteModal.Cancel') }}
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2 rounded-lg
                               bg-red-600 hover:bg-red-700 cursor-pointer
                               text-white font-semibold shadow">
                    {{ __('admin.OrderDeleteModal.Delete') }}
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    function openDeleteModal(orderId) {
        const modal = document.getElementById('deleteModal');
        const form  = document.getElementById('deleteForm');

        form.action = `/admin/orders/${orderId}`;
        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection
