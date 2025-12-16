@extends('template.mainAdmin')
@section('Title','Manage Reviews')

@section('Content')
<div class="p-12 min-h-screen">

    {{-- HEADER --}}
    <div class="relative mb-8 flex items-center">
        <a href="{{ route('admin.manage') }}"
           class="btn btn-secondary rounded-xl text-sm sm:text-base px-3 sm:px-4">
            <i class="fa-solid fa-backward"></i>
            {{ __('admin.Back')}}
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2 text-2xl sm:text-3xl font-bold text-blue-700">
            {{ __('admin.ReviewTable.Title') }}
        </h2>
    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-3xl shadow-xl p-8 overflow-x-auto">

        <table class="min-w-full text-sm text-gray-800">
            <thead>
                <tr class="text-left text-gray-600">
                    <th class="py-4 px-4">{{ __('admin.ReviewTable.No') }}</th>
                    <th class="py-4 px-4">{{ __('admin.ReviewTable.OrderID') }}</th>
                    <th class="py-4 px-4">{{ __('admin.ReviewTable.Titiper') }}</th>
                    <th class="py-4 px-4">{{ __('admin.ReviewTable.Runner') }}</th>
                    <th class="py-4 px-4">{{ __('admin.ReviewTable.Rating') }}</th>
                    <th class="py-4 px-4">{{ __('admin.ReviewTable.Comment') }}</th>
                    <th class="py-4 px-4">{{ __('admin.ReviewTable.Date') }}</th>
                    <th class="py-4 px-4 text-center">{{ __('admin.ReviewTable.Action') }}</th>
                </tr>
            </thead>

            <tbody>
            @foreach($reviews as $index => $review)
                <tr class="hover:bg-gray-50 transition">

                    {{-- NO (AMAN PAGINATION) --}}
                    <td class="py-5 px-4 font-semibold">
                        {{ $reviews->firstItem() + $index }}
                    </td>

                    <td class="py-5 px-4 font-medium">
                        #{{ $review->order_id }}
                    </td>

                    <td class="py-5 px-4 font-semibold">
                        {{ $review->reviewer->name ?? '-' }}
                    </td>

                    <td class="py-5 px-4">
                        {{ $review->reviewedUser->name ?? '-' }}
                    </td>

                    <td class="py-5 px-4">
                        <span class="inline-flex items-center gap-1 font-semibold text-yellow-500">
                            <i class="fa-solid fa-star"></i>
                            {{ $review->rating }}/5
                        </span>
                    </td>

                    <td class="py-5 px-4 max-w-sm truncate text-gray-600">
                        {{ $review->comment ?? '-' }}
                    </td>

                    <td class="py-5 px-4 text-gray-600">
                        {{ $review->created_at?->format('d M Y') }}
                    </td>

                    {{-- ACTION --}}
                    <td class="py-5 px-4 text-center space-x-1">

                        {{-- DETAIL --}}
                        <a href="{{ route('reviews.show', $review->id) }}"
                           class="btn btn-l mb-2 bg-blue-800 hover:bg-blue-900 hover:text-white">
                            <i class="fa-solid fa-circle-info"></i>
                            {{ __('admin.Details') }}
                        </a>

                        {{-- DELETE --}}
                        <button
                            onclick="openDeleteModal({{ $review->id }})"
                            class="btn btn-l mb-2 bg-red-500 hover:bg-red-700 hover:text-white">
                            <i class="fa-solid fa-trash"></i>
                            {{ __('admin.Delete') }}
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="mt-8 flex justify-end">
            {{ $reviews->links('pagination::tailwind') }}
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
                {{ __('admin.DeleteReviewModal.Title') }}
            </h3>
        </div>

        <p class="text-gray-700 mb-6">
            {{ __('admin.DeleteReviewModal.Message1') }}
            <br>
            <span class="text-sm text-gray-500">
                {{ __('admin.DeleteReviewModal.Message2') }}
            </span>
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()"
                    class="px-5 py-2 rounded-lg
                           border border-gray-300
                           text-gray-700 hover:bg-gray-100">
                {{ __('admin.LocDeleteModal.Cancel') }}
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2 rounded-lg
                               bg-red-600 hover:bg-red-700
                               text-white font-semibold shadow">
                    {{ __('admin.Delete') }}
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    function openDeleteModal(reviewId) {
        const modal = document.getElementById('deleteModal');
        const form  = document.getElementById('deleteForm');

        form.action = `/admin/reviews/${reviewId}`;
        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection
