<div class="container pt-lg-2 pb-5 mb-md-3">
    <h2 class="h3 text-center pb-3">Other Variants</h2>

    <div class="tns-carousel tns-controls-static tns-controls-outside">
        <div class="tns-carousel-inner"
            data-carousel-options="{&quot;items&quot;: 2, &quot;controls&quot;: true, &quot;nav&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;768&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;items&quot;:4, &quot;gutter&quot;: 30}}}">
            @foreach ($stocks ?? [] as $stock)
                <!-- Product-->
                <div>
                    <div class="card product-card card-static">
                        <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Add to wishlist">
                            <i class="ci-heart"></i>
                        </button>

                        <a class="card-img-top d-block overflow-hidden" href="javascript://">
                            @if ($stock->hasMedia(['image']))
                                <img src="{{ $stock->media('image')->first()->getUrl() }}" alt="Product" />
                            @elseif ($stock->variant->hasMedia('image'))
                                <img src="{{ $stock->variant->media('image')->first()->getUrl() }}" alt="Product" />
                            @elseif ($stock->variant->product->hasMedia('image'))
                                <img src="{{ $stock->variant->product->media('image')->first()->getUrl() }}"
                                    alt="Product" />
                            @else
                                <img src="{{ asset('app') }}/img/shop/catalog/66.jpg" alt="Product" />
                            @endif
                        </a>

                        <div class="card-body py-2">
                            <a class="product-meta d-block fs-xs pb-1" href="javascript://">Smartwatches</a>

                            <h3 class="product-title fs-sm">
                                <a href="javascript://">{!! $stock->title !!}</a>
                            </h3>

                            <div class="d-flex justify-content-between flex-wrap align-items-center mt-1">
                                <!-- Price -->
                                @php
                                    $k_price = number_format_k((float) optional($stock->price)->amount);
                                    $price = explode('.', $k_price);
                                @endphp

                                <div class="product-price text-muted">
                                    <span aria-label="Currency" title="Currency"
                                        data-bs-toggle="tooltip">{{ currency('NGN', 'NGN') }}</span>
                                    <span class="text-accent fw-bold" aria-label="Price" title="Price"
                                        data-bs-toggle="tooltip">{{ $price[0] }}.<small>{{ $price[1] }}</small></span>
                                </div>

                                <!-- Size -->
                                @if ($stock->variant->size)
                                    <div class="product-size text-muted">
                                        <span aria-label="Size" title="Size"
                                            data-bs-toggle="tooltip">{{ $stock->variant->size }}</span>
                                        @if ($stock->variant->unit)
                                            <span aria-label="{{ $stock->variant->unit->name }}"
                                                title="{{ $stock->variant->unit->name }}"
                                                data-bs-toggle="tooltip">{{ $stock->variant->unit->code }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Rating -->
                            <div class="d-flex flex-wrap justify-content-between align-items-start mt-1">
                                <div class="text-muted fs-xs me-1">
                                    <span class="product-meta fw-medium" aria-label="Rates" title="Rates"
                                        data-bs-toggle="tooltip">5/5</span>
                                </div>

                                <div property="aggregateRating" typeof="AggregateRating" class="star-rating me-1"
                                    aria-label="Aggregate Rating" title="Rating" data-bs-toggle="tooltip">
                                    <i class="star-rating-icon ci-star-filled active"></i>
                                    <i class="star-rating-icon ci-star-filled active"></i>
                                    <i class="star-rating-icon ci-star-filled active"></i>
                                    <i class="star-rating-icon ci-star-filled active"></i>
                                    <i class="star-rating-icon ci-star-filled active"></i>
                                </div>

                                {{--
                                    <div class="text-muted fs-xs me-1">
                                    <span class="product-meta fw-medium" aria-label="Rated by"
                                        title="Rated by" data-bs-toggle="tooltip">(100)</span>
                                    </div>
                                --}}

                                <div class="text-muted fs-xs" aria-label="Likes" title="Likes"
                                    data-bs-toggle="tooltip">
                                    <span class="">
                                        <i class="fas fa-thumbs-up"></i>
                                        100
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--
                <!-- Product-->
                <div>
                    <div class="card product-card card-static">
                        <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Add to wishlist"><i class="ci-heart"></i></button><a
                            class="card-img-top d-block overflow-hidden" href="javascript://"><img
                                src="{{ asset('app') }}/img/shop/catalog/67.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"
                                href="javascript://">Smartwatches</a>
                            <h3 class="product-title fs-sm"><a href="javascript://">Heart Rate &amp; Activity
                                    Tracker</a>
                            </h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price text-accent">$26.<small>99</small></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-half active"></i><i
                                        class="star-rating-icon ci-star"></i><i class="star-rating-icon ci-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product-->
                <div>
                    <div class="card product-card card-static">
                        <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Add to wishlist"><i class="ci-heart"></i></button><a
                            class="card-img-top d-block overflow-hidden" href="javascript://"><img
                                src="{{ asset('app') }}/img/shop/catalog/64.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"
                                href="javascript://">Smartwatches</a>
                            <h3 class="product-title fs-sm"><a href="javascript://">Smart Watch Series 5, Aluminium</a>
                            </h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price text-accent">$349.<small>99</small></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product-->
                <div>
                    <div class="card product-card card-static">
                        <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Add to wishlist"><i class="ci-heart"></i></button><a
                            class="card-img-top d-block overflow-hidden" href="javascript://"><img
                                src="{{ asset('app') }}/img/shop/catalog/68.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"
                                href="javascript://">Smartwatches</a>
                            <h3 class="product-title fs-sm"><a href="javascript://">Health &amp; Fitness Smartwatch</a>
                            </h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price text-accent">$118.<small>00</small></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product-->
                <div>
                    <div class="card product-card card-static">
                        <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip"
                            data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a
                            class="card-img-top d-block overflow-hidden" href="javascript://"><img
                                src="{{ asset('app') }}/img/shop/catalog/69.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"
                                href="javascript://">Smartwatches</a>
                            <h3 class="product-title fs-sm"><a href="javascript://">Heart Rate &amp; Activity
                                    Tracker</a>
                            </h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price text-accent">$25.<small>00</small></div>
                                <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-filled active"></i><i
                                        class="star-rating-icon ci-star-half active"></i><i
                                        class="star-rating-icon ci-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            --}}
        </div>
    </div>
</div>
