<x-app-layout :title="$title ?? 'Products'">
    <x-slot name="header">
        <div class="page-title-overlap bg-accent pt-1">
            <div
                class="container _d-flex _flex-wrap _flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
                <div class="row">
                    {{--  --}}
                </div>
            </div>
        </div>
    </x-slot>

    {{-- Content --}}
    <section class="col-lg-9">
        <!-- Toolbar-->
        <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-3">
            {{-- Search --}}
            {{-- <livewire:search-page /> --}}

            <div class="d-flex flex-wrap">
                <div class="d-flex align-items-center flex-nowrap me-3 me-sm-4 _pb-3">
                    <label class="text-light opacity-75 text-nowrap fs-sm me-2 d-none d-sm-block" for="sorting">
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

                    <span class="fs-sm text-light opacity-75 text-nowrap ms-2 d-none d-md-block">
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
                <a class="btn btn-icon nav-link-style bg-light text-dark disabled opacity-100 me-2"
                    href="javascript://">
                    <i class="ci-view-grid"></i>
                </a>

                <a class="btn btn-icon nav-link-style nav-link-light" href="javascript://#list">
                    <i class="ci-view-list"></i>
                </a>
            </div>
        </div>

        {{-- <x-product::office.submenu :product="$product ?? null" /> --}}

        <section>
            <!-- Button tabs-->
            <div class="mb-3" style="overflow-x: auto;">
                <div class="nav nav-tabs d-inline-flex ms-n1 mb-0 border-0 flex-nowrap text-nowrap" role="tablist">
                    <div class="btn btn-outline-accent active position-relative ms-1 me-2 mb-2"
                        data-bs-target="#all-products-tab" data-bs-toggle="tab" role="tab">
                        <i class="ci-lable me-2"></i>
                        All products
                        <label class="position-absolute top-0 start-0 w-100 h-100" style="cursor: pointer;">
                            <input class="visually-hidden" type="radio" name="all_products" checked>
                        </label>
                    </div>

                    {{-- <div class="btn btn-outline-accent position-relative ms-1 me-2 mb-2"
                                data-bs-target="#my-products-tab" data-bs-toggle="tab" role="tab">
                                <i class="ci-auction me-2"></i>
                                My products
                                <label class="position-absolute top-0 start-0 w-100 h-100" style="cursor: pointer;">
                                    <input class="visually-hidden" type="radio" name="my_products">
                                </label>
                            </div> --}}
                </div>
            </div>

            <!-- Tabs content-->
            <div class="tab-content">
                <!-- All products-->
                <div class="tab-pane fade mb-3 pb-2 show active" id="all-products-tab" role="tabpanel">
                    {{-- <livewire:product.office.index /> --}}
                </div>

                {{-- <!-- My products--> <div class="tab-pane fade mb-3 pb-2" id="my-products-tab" role="tabpanel"> ... </div> --}}
            </div>
        </section>
    </section>
</x-app-layout>
