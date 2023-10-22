<x-app-sidebar-layout :data="$head ?? []">
    <x-slot name="header">
        <div class="page-title-overlap bg-accent pt-1">
            <div
                class="_d-flex _flex-wrap _flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center container pt-2">
                <div class="row">
                    <!--  -->
                    <div class="col-md-8 col-sm-12 d-flex align-items-center pb-3">
                        <!-- Logo -->
                        <div class="img-thumbnail rounded-circle position-relative flex-shrink-0"
                            style="width: 6.375rem; height: 6.375rem;">
                            <img class="rounded-circle"
                                src="{{ $business->hasMedia(['image', 'logo'])? $business->media(['image', 'logo'])->first()->getUrl(): asset('app') }}/img/marketplace/account/avatar.png"
                                alt="Logo">
                        </div>

                        <div class="col ps-3">
                            <!-- Title -->
                            <h3 class="text-light fs-lg mb-0">
                                <span>{!! $business->name !!}</span>

                                @if ($business->verified)
                                    <i class="fas fa-circle-check text-success" title="Verified"
                                        _data-bs-toggle="tooltip"></i>
                                @else
                                    <i class="fa-solid fa-circle-xmark text-muted" title="Unverified"></i>
                                @endif
                            </h3>

                            {{-- <p class="text-light d-none d-md-block fs-ms pt-2">{{ $business->description }}</p> --}}
                            <span class="d-block text-light fs-ms py-1 opacity-60">
                                Active: {{ $business->created_at->calendar() }}
                            </span>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="col-md-4 col-sm-12">
                        <div class="row">
                            <div class="col-6 text-sm-end">
                                <div class="text-light fs-base">Sales</div>
                                <h3 class="text-light">0.00</h3>
                            </div>

                            <div class="col-6 text-end">
                                <div class="text-light fs-base">Rating</div>
                                <div class="star-rating">
                                    {{-- <i class="star-rating-icon ci-star-filled active"></i> --}}
                                    <i class="star-rating-icon ci-star"></i>
                                    <i class="star-rating-icon ci-star"></i>
                                    <i class="star-rating-icon ci-star"></i>
                                    <i class="star-rating-icon ci-star"></i>
                                    <i class="star-rating-icon ci-star"></i>
                                </div>
                                <div class="text-light fs-xs opacity-60">Based on ... reviews</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Toolbar-->
    <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-3">
        {{-- Search --}}
        <livewire:search-page />

        <div class="d-flex flex-wrap">
            <div class="d-flex align-items-center me-3 me-sm-4 _pb-3 flex-nowrap">
                <label class="text-light text-nowrap fs-sm me-2 d-none d-sm-block opacity-75" for="sorting">
                    Sort by:
                </label>
                <select disabled class="form-select" id="sorting">
                    <option>Recent</option>
                    <option>Popularity</option>
                    <option>Low - Hight Price</option>
                    <option>High - Low Price</option>
                    <option>Average Rating</option>
                    <option>A - Z Order</option>
                    <option>Z - A Order</option>
                </select>

                <span class="fs-sm text-light text-nowrap ms-2 d-none d-md-block opacity-75">
                    ... of ... products
                </span>
            </div>
        </div>

        <div class="d-flex _pb-3">
            <a class="nav-link-style nav-link-light me-3" href="javascript://">
                <i class="ci-arrow-left"></i>
            </a>
            <span class="fs-md text-light">1 / ...</span>
            <a class="nav-link-style nav-link-light ms-3" href="javascript://">
                <i class="ci-arrow-right"></i>
            </a>
        </div>

        <div class="d-none d-sm-flex _pb-3">
            <a class="btn btn-icon nav-link-style bg-light text-dark disabled me-2 opacity-100" href="javascript://">
                <i class="ci-view-grid"></i>
            </a>

            <a class="btn btn-icon nav-link-style nav-link-light" href="javascript://#list">
                <i class="ci-view-list"></i>
            </a>
        </div>
    </div>

    <x-product::office.submenu />
    <livewire:product::office.index />
</x-app-sidebar-layout>
