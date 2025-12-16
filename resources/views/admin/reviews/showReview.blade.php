@extends('template.mainAdmin')
@section('Title','Review Detail')

@section('Content')
<div class="p-12 min-h-screen bg-gray-50">

    {{-- HEADER --}}
    <div class="relative mb-8 flex items-center">
        <a href="{{ route('reviews.index') }}"
           class="btn btn-secondary rounded-xl text-sm sm:text-base px-3 sm:px-4">
            <i class="fa-solid fa-backward"></i>
            {{ __('admin.Back')}}
        </a>

        <h2 class="absolute left-1/2 -translate-x-1/2 text-2xl sm:text-3xl font-bold text-blue-700">
            {{ __('admin.ReviewDetailPage.Title') }}
        </h2>
    </div>

    {{-- CARD --}}
    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xl p-8">

        {{-- ORDER INFO --}}
        <div class="mb-6">
            <p class="text-sm text-gray-500">{{ __('admin.ReviewDetailPage.OrderID') }}</p>
            <p class="text-lg font-bold text-gray-900">
                #{{ $review->order_id }}
            </p>
        </div>

        {{-- USERS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">

            <div>
                <p class="text-sm text-gray-500">{{ __('admin.ReviewDetailPage.Titiper') }}</p>
                <p class="text-lg font-semibold text-gray-900">
                    {{ $review->reviewer->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">{{ __('admin.ReviewDetailPage.Runner') }}</p>
                <p class="text-lg font-semibold text-gray-900">
                    {{ $review->reviewedUser->name ?? '-' }}
                </p>
            </div>

        </div>

        {{-- RATING --}}
        <div class="mb-6">
            <p class="text-sm text-gray-500 mb-1">{{ __('admin.ReviewDetailPage.Rating') }}</p>
            <div class="flex items-center gap-2 text-yellow-500 text-lg font-bold">
                <i class="fa-solid fa-star"></i>
                {{ $review->rating }}/5
            </div>
        </div>

        {{-- COMMENT --}}
        <div class="mb-6">
            <p class="text-sm text-gray-500 mb-2">{{ __('admin.ReviewDetailPage.Comment') }}</p>
            <div class="bg-gray-50 border border-gray-200
                        rounded-xl p-4 text-gray-800 leading-relaxed">
                {{ $review->comment ?? 'Tidak ada komentar.' }}
            </div>
        </div>

        {{-- DATE --}}
        <div class="text-sm text-gray-500 text-right">
            {{ __('admin.ReviewDetailPage.Created') }}
            {{ $review->created_at?->format('d M Y, H:i') }}
        </div>

    </div>
</div>
@endsection
