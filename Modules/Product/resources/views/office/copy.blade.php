<x-app-sidebar-layout title="Office">
    <x-slot name="header">
        <div class="page-title-overlap bg-accent pt-1">
            <div
                class="container _d-flex _flex-wrap _flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
                <div class="row">
                    <div class="col-md-8 col-sm-12 d-flex align-items-center pb-3">
                        <div class="img-thumbnail rounded position-relative flex-shrink-0" style="width: 6.375rem;">
                            <a href="{{ route('office.product.show', $product->id) }}" class="">
                                <img class="rounded" src="{{ asset('app') }}/img/nft/catalog/06.jpg" alt="...">
                            </a>
                        </div>
                        <div class="col ps-3">
                            <h3 class="text-light fs-lg mb-0">
                                <a href="{{ route('office.product.show', $product->id) }}" class="text-light">
                                    <span>{!! $product->name !!}</span>
                                </a>
                                @if ($product->private)
                                    <span class="ps-1" data-bs-toggle="tooltip" title="Private">
                                        <i class="fas fa-shield text-muted"></i>
                                    </span>
                                @else
                                    <span class="ps-1" data-bs-toggle="tooltip" title="Public">
                                        <i class="fa-solid fa-users text-muted"></i>
                                    </span>
                                @endif
                            </h3>
                            @if ($product->description)
                                <p class="text-light d-none d-md-block fs-ms pt-2">{{ $product->description }}</p>
                            @endif
                            <span class="d-block text-light fs-ms opacity-60 py-1">
                                Last updated: {{ $product->created_at->format('M Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="row">
                            <div class="col-6 text-sm-end">
                                <div class="text-light fs-base">Total sales</div>
                                <h3 class="text-light">...</h3>
                            </div>

                            <div class="col-6 text-end">
                                <div class="text-light fs-base">Rating</div>
                                <div class="star-rating">
                                    {{-- <i class="star-rating-label ci-star-filled active"></i> --}}
                                    <i class="star-rating-label ci-star"></i>
                                    <i class="star-rating-label ci-star"></i>
                                    <i class="star-rating-label ci-star"></i>
                                    <i class="star-rating-label ci-star"></i>
                                    <i class="star-rating-label ci-star"></i>
                                </div>
                                <div class="text-light opacity-60 fs-xs">... reviews</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    {{-- Content --}}
    <livewire:product.office.copy :product="$product" />
</x-app-sidebar-layout>
