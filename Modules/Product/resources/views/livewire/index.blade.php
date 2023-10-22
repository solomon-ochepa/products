<section>
    <x-slot name="header">
        <!-- Page title-->
        <div class="page-title-overlap bg-dark">
            <div class="container d-lg-flex justify-content-between py-3">
                <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                    <nav aria-label="breadcrumb">
                        <ol
                            class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                            <li class="breadcrumb-item">
                                <a class="text-nowrap" href="{{ route('home') }}">
                                    <i class="ci-home"></i>
                                    {!! tenant()->name ?? config('app.name') !!}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a class="text-nowrap" href="{{ route('product.index') }}">
                                    <i class="ci-gift"></i>
                                    {{ __('Products') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item text-nowrap active" aria-current="page">
                                {!! $head['title'] ?? ($title ?? '') !!}
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                    <h1 class="h3 text-light mb-2">
                        {!! $head['title'] ?? ($title ?? '') !!}
                    </h1>

                    @if ($product->exists)
                        <div>
                            <div class="star-rating">
                                <i class="star-rating-icon ci-star-filled active"></i>
                                <i class="star-rating-icon ci-star-filled active"></i>
                                <i class="star-rating-icon ci-star-filled active"></i>
                                <i class="star-rating-icon ci-star-filled active"></i>
                                <i class="star-rating-icon ci-star"></i>
                            </div>

                            <span class="d-inline-block fs-sm text-white opacity-70 align-middle mt-1 ms-1">
                                74 Reviews
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <section class="container">
        <div class="row">
            <!-- Sidebar-->
            <livewire:product::sidebar :data="['col'=>3]" />

            <!-- Content  -->
            <section class="col-lg-9">
                <!-- Toolbar-->
                <div
                    class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-4 pb-sm-5">
                    <div class="d-flex flex-wrap">
                        <div class="d-flex align-items-center flex-nowrap me-3 me-sm-4 pb-3">
                            <label class="text-light opacity-75 text-nowrap fs-sm me-2 d-none d-sm-block"
                                for="sorting">Sort by:</label>
                            <select class="form-select" id="sorting">
                                <option>Popularity</option>
                                <option>Low - Hight Price</option>
                                <option>High - Low Price</option>
                                <option>Average Rating</option>
                                <option>A - Z Order</option>
                                <option>Z - A Order</option>
                            </select><span class="fs-sm text-light opacity-75 text-nowrap ms-2 d-none d-md-block">of
                                287
                                products</span>
                        </div>
                    </div>
                    <div class="d-flex pb-3"><a class="nav-link-style nav-link-light me-3" href="javascript://"><i
                                class="ci-arrow-left"></i></a><span class="fs-md text-light">1 / 5</span><a
                            class="nav-link-style nav-link-light ms-3" href="javascript://"><i
                                class="ci-arrow-right"></i></a>
                    </div>
                    <div class="d-none d-sm-flex pb-3"><a
                            class="btn btn-icon nav-link-style bg-light text-dark disabled opacity-100 me-2"
                            href="javascript://"><i class="ci-view-grid"></i></a><a
                            class="btn btn-icon nav-link-style nav-link-light" href="shop-list-ls.html"><i
                                class="ci-view-list"></i></a></div>
                </div>

                <!-- Products grid-->
                <div class="row gx-1">
                    @if ($stocks)
                        @foreach ($stocks /*->shuffle()*/ ?? [] as $stock)
                            <div class="col-md-3 col-sm-6 -px-2 mb-4 mb-grid-gutter">
                                <livewire:product::product :stock="$stock" />
                            </div>
                        @endforeach

                        <hr class="my-3">

                        <!-- Pagination-->
                        <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="javascript://"><i
                                            class="ci-arrow-left me-2"></i>Prev</a></li>
                            </ul>
                            <ul class="pagination">
                                <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span>
                                </li>
                                <li class="page-item active d-none d-sm-block" aria-current="page"><span
                                        class="page-link">1<span class="visually-hidden">(current)</span></span></li>
                                <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript://">2</a>
                                </li>
                                <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript://">3</a>
                                </li>
                                <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript://">4</a>
                                </li>
                                <li class="page-item d-none d-sm-block"><a class="page-link" href="javascript://">5</a>
                                </li>
                            </ul>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="javascript://" aria-label="Next">Next<i
                                            class="ci-arrow-right ms-2"></i></a></li>
                            </ul>
                        </nav>
                    @else
                        <p class="py-4 text-center">No records found.</p>
                    @endif
                </div>
            </section>
        </div>
    </section>

    @pushOnce('css')
        <link rel="stylesheet" media="screen" href="{{ asset('app') }}/vendor/nouislider/dist/nouislider.min.css" />
    @endPushOnce
    @pushOnce('js')
        <script src="{{ asset('app') }}/vendor/nouislider/dist/nouislider.min.js"></script>
    @endPushOnce
</section>
