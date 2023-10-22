{{-- <x-app-layout :data="$head ?? []"> --}}
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
                                    {!! tenant()->name ?? config('app.name') !!}</a>
                            </li>

                            <li class="breadcrumb-item text-nowrap active" aria-current="page">
                                {!! $head['title'] ?? ($title ?? '') !!}
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                    <h1 class="h3 text-light mb-2">
                        {!! $head['title'] ?? ($title ?? '') !!} {!! $stock->size ? ' &middot; ' . $stock->size : '' !!}
                    </h1>
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
                </div>
            </div>
        </div>
    </x-slot>

    <section class="container">
        <div class="bg-light rounded-3 shadow-lg">
            <!-- Tabs-->
            <x-product::show.navtabs :reviews="$reviews" />

            <div class="pt-lg-3 mb-5 px-4 pb-3">
                <div class="tab-content px-lg-3">
                    <!-- General info tab-->
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <div class="row">
                            <!-- Product gallery-->
                            <div class="col-lg-7 pe-lg-0">
                                <div class="product-gallery">
                                    {{-- Featured Images --}}
                                    <div class="product-gallery-preview order-sm-2">
                                        @foreach ($featured_images ?? [] as $key => $item)
                                            <div class="product-gallery-preview-item{{ $key == 0 ? ' active' : '' }}"
                                                id="featured-image-{{ $key }}">
                                                <img alt="Product image" class="image-zoom rounded"
                                                    data-zoom="{{ $item->getUrl() }}" src="{{ $item->getUrl() }}" />
                                                <div class="image-zoom-pane rounded"></div>
                                            </div>
                                        @endforeach
                                        {{-- @todo Add: featured video --}}
                                    </div>

                                    <div class="product-gallery-thumblist order-sm-1">
                                        {{-- Images (Thumb) --}}
                                        @foreach ($featured_images ?? [] as $key => $item)
                                            <a class="product-gallery-thumblist-item{{ $key == 0 ? ' active' : '' }}"
                                                href="#featured-image-{{ $key }}">
                                                <img alt="Product thumb" src="{{ $item->getUrl() }}" />
                                            </a>
                                        @endforeach

                                        {{-- Video (Thumb) --}}
                                        @if ($product->hasMedia(['video']))
                                            <a class="product-gallery-thumblist-item video-item"
                                                href="{{ $product->media(['video'])->first()->getUrl() }}">
                                                <div class="product-gallery-thumblist-item-text">
                                                    <i class="ci-video"></i>Video
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Product details-->
                            <div class="col-lg-5 pt-lg-0 pt-4">
                                <div class="product-details ms-auto pb-3">
                                    <!-- Price -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="h3 fw-normal text-accent me-1">{!! $amount !!}</div>

                                        @isset($stock)
                                            <div>
                                                <span>Size:</span>
                                                <span>{!! $stock->variant->size ? $stock->variant->size : '' !!}</span>
                                                @if ($stock->variant->unit)
                                                    <span>{!! $stock->variant->unit->code !!}</span>
                                                @endif
                                            </div>
                                        @endisset
                                    </div>

                                    <!-- Attributes -->
                                    <div class="fs-sm mb-4">
                                        <span class="text-heading fw-medium me-1">Color:</span>
                                        <span class="text-muted" id="colorOption">Dark blue/Orange</span>
                                    </div>

                                    <div class="position-relative me-n4 mb-3">
                                        <div class="form-check form-option form-check-inline mb-2">
                                            {{-- <input checked class="form-check-input" data-bs-label="colorOption"
                                            id="color1" name="color" type="radio" value="Dark blue/Orange">
                                        <label class="form-option-label rounded-circle" for="color1">
                                            <span class="form-option-color rounded-circle"
                                                style="background-color: #f25540;"></span>
                                        </label> --}}
                                        </div>

                                        {{-- <div class="form-check form-option form-check-inline mb-2">
                                        <input class="form-check-input" data-bs-label="colorOption" id="color2"
                                            name="color" type="radio" value="Dark blue/Green">
                                        <label class="form-option-label rounded-circle" for="color2">
                                            <span class="form-option-color rounded-circle"
                                                style="background-color: #65805b;"></span>
                                        </label>
                                    </div>

                                    <div class="form-check form-option form-check-inline mb-2">
                                        <input class="form-check-input" data-bs-label="colorOption" id="color3"
                                            name="color" type="radio" value="Dark blue/White">
                                        <label class="form-option-label rounded-circle" for="color3">
                                            <span class="form-option-color rounded-circle"
                                                style="background-color: #f5f5f5;"></span>
                                        </label>
                                    </div>

                                    <div class="form-check form-option form-check-inline mb-2">
                                        <input class="form-check-input" data-bs-label="colorOption" id="color4"
                                            name="color" type="radio" value="Dark blue/Black">
                                        <label class="form-option-label rounded-circle" for="color4">
                                            <span class="form-option-color rounded-circle"
                                                style="background-color: #333;"></span>
                                        </label>
                                    </div> --}}

                                        <div class="product-badge product-available mt-n1">
                                            @if (isset($stock) and $stock->available)
                                                <i class="ci-security-check"></i> Product available
                                            @else
                                                <i class="ci-time"></i> Processing ...
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Add to Cart -->
                                    <livewire:product::add-to-cart :item="$stock ?? null" />

                                    <!-- Wishlist & Compare -->
                                    <div class="d-flex mb-4">
                                        <!-- Wishlist -->
                                        <div class="w-100 me-3">
                                            <button class="btn btn-secondary d-block w-100" type="button">
                                                <i class="ci-heart fs-lg me-2"></i>
                                                <span class='d-none d-sm-inline'>Add to </span>Wishlist
                                            </button>
                                        </div>

                                        <!-- Compare -->
                                        <div class="w-100">
                                            <button class="btn btn-secondary d-block w-100" type="button"><i
                                                    class="ci-compare fs-lg me-2"></i>Compare</button>
                                        </div>
                                    </div>

                                    <!-- Product panels-->
                                    <div class="accordion mb-4" id="productPanels">
                                        <!-- Product info -->
                                        <div class="accordion-item">
                                            <h3 class="accordion-header">
                                                <a class="accordion-button" href="#productInfo" role="button"
                                                    data-bs-toggle="collapse" aria-expanded="true"
                                                    aria-controls="productInfo">
                                                    <i
                                                        class="ci-announcement text-muted fs-lg align-middle mt-n1 me-2"></i>
                                                    Product info
                                                </a>
                                            </h3>

                                            <div class="accordion-collapse collapse show" id="productInfo"
                                                data-bs-parent="#productPanels">
                                                <div class="accordion-body fs-sm">
                                                    {{-- <h6 class="fs-sm mb-2">Composition</h6>
                                                <ul class="fs-sm ps-4">
                                                    <li>Elastic rib: Cotton 95%, Elastane 5%</li>
                                                    <li>Lining: Cotton 100%</li>
                                                    <li>Cotton 80%, Polyester 20%</li>
                                                </ul>
                                                <h6 class="fs-sm mb-2">Art. No.</h6>
                                                <ul class="fs-sm ps-4 mb-0">
                                                    <li>183260098</li>
                                                </ul> --}}

                                                    @if ($product->manufacturer)
                                                        <div class="d-flex justify-content-between border-bottom py-2">
                                                            <div>
                                                                <div class="fw-semibold text-dark">
                                                                    Manufacturer
                                                                </div>
                                                            </div>
                                                            <div> {{ $product->manufacturer->name }} </div>
                                                        </div>
                                                    @endif

                                                    @if (isset($variant) and $variant->barcode)
                                                        <div class="d-flex justify-content-between pt-2">
                                                            <div>
                                                                <div class="fw-semibold text-dark">
                                                                    Barcode
                                                                </div>
                                                            </div>
                                                            <div> {{ $variant->barcode }} </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h3 class="accordion-header">
                                                <a aria-controls="shippingOptions" aria-expanded="true"
                                                    class="accordion-button" data-bs-toggle="collapse"
                                                    href="#shippingOptions" role="button">
                                                    <i class="ci-delivery text-muted lead mt-n1 me-2 align-middle"></i>
                                                    Shipping options
                                                </a>
                                            </h3>
                                            <div class="accordion-collapse collapse" data-bs-parent="#productPanels"
                                                id="shippingOptions">
                                                <div class="accordion-body fs-sm">
                                                    <div class="d-flex justify-content-between border-bottom pb-2">
                                                        <div>
                                                            <div class="fw-semibold text-dark">Local courier
                                                                shipping</div>
                                                            <div class="fs-sm text-muted">2 - 4 days</div>
                                                        </div>
                                                        <div>$16.50</div>
                                                    </div>

                                                    <div class="d-flex justify-content-between border-bottom py-2">
                                                        <div>
                                                            <div class="fw-semibold text-dark">UPS ground
                                                                shipping</div>
                                                            <div class="fs-sm text-muted">4 - 6 days</div>
                                                        </div>
                                                        <div>$19.00</div>
                                                    </div>

                                                    <div class="d-flex justify-content-between pt-2">
                                                        <div>
                                                            <div class="fw-semibold text-dark">Local pickup from
                                                                store</div>
                                                            <div class="fs-sm text-muted">&mdash;</div>
                                                        </div>
                                                        <div>$0.00</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h3 class="accordion-header">
                                                <a aria-controls="localStore" aria-expanded="true"
                                                    class="accordion-button collapsed" data-bs-toggle="collapse"
                                                    href="#localStore" role="button">
                                                    <i
                                                        class="ci-location text-muted fs-lg mt-n1 me-2 align-middle"></i>
                                                    Find in local store
                                                </a>
                                            </h3>
                                            <div class="accordion-collapse collapse" data-bs-parent="#productPanels"
                                                id="localStore">
                                                <div class="accordion-body">
                                                    <select class="form-select">
                                                        <option value>Select your country</option>
                                                        <option value="Argentina">Argentina</option>
                                                        <option value="Belgium">Belgium</option>
                                                        <option value="France">France</option>
                                                        <option value="Germany">Germany</option>
                                                        <option value="Spain">Spain</option>
                                                        <option value="UK">United Kingdom</option>
                                                        <option value="USA">USA</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sharing-->
                                    <label class="form-label d-inline-block me-3 my-2 align-middle">Share:</label><a
                                        class="btn-share btn-twitter me-2 my-2" href="javascript://"><i
                                            class="ci-twitter"></i>Twitter</a><a
                                        class="btn-share btn-instagram me-2 my-2" href="javascript://"><i
                                            class="ci-instagram"></i>Instagram</a><a
                                        class="btn-share btn-facebook my-2" href="javascript://"><i
                                            class="ci-facebook"></i>Facebook</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tech specs tab-->
                    <div class="tab-pane fade" id="specs" role="tabpanel">
                        <div class="d-md-flex justify-content-between align-items-start border-bottom mb-4 pb-4">
                            <div class="d-flex align-items-center me-md-3"><img alt="Product thumb"
                                    src="{{ asset('app') }}/img/shop/single/gallery/th05.jpg" width="90">
                                <div class="ps-3">
                                    <h6 class="fs-base mb-2">Smartwatch Youth Edition</h6>
                                    <div class="h4 fw-normal text-accent">$124.<small>99</small></div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-3">
                                <select class="me-2 form-select" style="width: 5rem;">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button class="btn btn-primary btn-shadow me-2" type="button"><i
                                        class="ci-cart fs-lg me-sm-2"></i><span class="d-none d-sm-inline">Add
                                        to Cart</span></button>
                                <div class="me-2">
                                    <button class="btn btn-secondary btn-icon" data-bs-toggle="tooltip"
                                        title="Add to Wishlist" type="button"><i
                                            class="ci-heart fs-lg"></i></button>
                                </div>
                                <div>
                                    <button class="btn btn-secondary btn-icon" data-bs-toggle="tooltip"
                                        title="Compare" type="button"><i class="ci-compare fs-lg"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- Specs table-->
                        <div class="row pt-2">
                            <div class="col-lg-5 col-sm-6">
                                <h3 class="h6">General specs</h3>
                                <ul class="list-unstyled fs-sm pb-2">
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Model:</span><span>Amazfit Smartwatch</span></li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Gender:</span><span>Unisex</span></li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Smartphone app:</span><span>Amazfit Watch</span>
                                    </li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">OS campitibility:</span><span>Android /
                                            iOS</span></li>
                                </ul>
                                <h3 class="h6">Physical specs</h3>
                                <ul class="list-unstyled fs-sm pb-2">
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Shape:</span><span>Rectangular</span></li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Body material:</span><span>Plastics /
                                            Ceramics</span></li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Band material:</span><span>Silicone</span></li>
                                </ul>
                                <h3 class="h6">Display</h3>
                                <ul class="list-unstyled fs-sm pb-2">
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Display type:</span><span>Color</span></li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Display size:</span><span>1.28"</span></li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Screen resolution:</span><span>176 x 176</span>
                                    </li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Touch screen:</span><span>No</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-5 col-sm-6 offset-lg-1">
                                <h3 class="h6">Functions</h3>
                                <ul class="list-unstyled fs-sm pb-2">
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Phone calls:</span><span>Incoming call
                                            notification</span></li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Monitoring:</span><span>Heart rate / Physical
                                            activity</span></li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">GPS support:</span><span>Yes</span></li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Sensors:</span><span>Heart rate, Gyroscope,
                                            Geomagnetic, Light sensor</span></li>
                                </ul>
                                <h3 class="h6">Battery</h3>
                                <ul class="list-unstyled fs-sm pb-2">
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Battery:</span><span>Li-Pol</span></li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Battery capacity:</span><span>190 mAh</span></li>
                                </ul>
                                <h3 class="h6">Dimensions</h3>
                                <ul class="list-unstyled fs-sm pb-2">
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Dimensions:</span><span>195 x 20 mm</span></li>
                                    <li class="d-flex justify-content-between border-bottom pb-2"><span
                                            class="text-muted">Weight:</span><span>32 g</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews tab-->
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="d-md-flex justify-content-between align-items-start border-bottom mb-4 pb-4">
                            <div class="d-flex align-items-center me-md-3">
                                <img alt="Product thumb" src="{{ $featured_image_thumb }}" width="90">
                                <div class="ps-3">
                                    {{-- Title --}}
                                    <h6 class="fs-base mb-2">{!! $stock->title ?? '...' !!}</h6>
                                    {{-- Price --}}
                                    <div class="h4 fw-normal text-accent">{!! $amount !!}</div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center pt-3">
                                <livewire:product::add-to-cart :item="$stock ?? null" />
                                {{-- Quantity --}}
                                {{-- <input class="form-control me-2" max="" min="1" name="order[unit]"
                                placeholder="Qty" required step="1" style="width: 6rem;" type="number" /> --}}

                                {{-- Add to Cart --}}
                                {{-- <button class="btn btn-primary btn-shadow me-2" disabled type="button">
                                <i class="ci-cart fs-lg me-sm-2"></i>
                                <span class="d-none d-sm-inline">Add to Cart</span>
                            </button> --}}

                                {{-- Add to Wishlist --}}
                                <div class="me-2">
                                    <button class="btn btn-secondary btn-icon" data-bs-toggle="tooltip" disabled
                                        title="Add to Wishlist" type="button">
                                        <i class="ci-heart fs-lg"></i>
                                    </button>
                                </div>

                                {{-- Add to Compare --}}
                                <div>
                                    <button class="btn btn-secondary btn-icon" data-bs-toggle="tooltip" disabled
                                        title="Compare" type="button">
                                        <i class="ci-compare fs-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews-->
                        <div class="row pt-2 pb-3">
                            <div class="col-lg-4 col-md-5">
                                <h2 class="h3 mb-4">{{ $reviews ? $reviews->count() : '' }} Reviews</h2>
                                {{-- Rating --}}
                                <div class="star-rating me-2">
                                    {{-- @dd($reviews) --}}
                                    @php
                                        $avg_rates = $reviews ? $reviews->avg('total') : 0;
                                    @endphp
                                    @for ($i = 5.0; $i >= 1; $i--)
                                        @if ($i == 1)
                                            <i class="ci-star-filled fs-sm text-accent me-1"></i>
                                        @else
                                            <i class="ci-star fs-sm text-muted me-1"></i>
                                        @endif
                                    @endfor
                                </div>

                                <span class="d-inline-block align-middle">
                                    {{ $reviews ? $reviews->avg('total') : '0.0' }} Overall rating
                                </span>

                                <p class="fs-sm text-muted pt-3">
                                    58 out of 74 (77%)<br>
                                    Customers recommended this product
                                </p>
                            </div>

                            <div class="col-lg-8 col-md-7">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="text-nowrap me-3"><span
                                            class="d-inline-block text-muted align-middle">5</span><i
                                            class="ci-star-filled fs-xs ms-1"></i></div>
                                    <div class="w-100">
                                        <div class="progress" style="height: 4px;">
                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="60"
                                                class="progress-bar bg-success" role="progressbar"
                                                style="width: 60%;">
                                            </div>
                                        </div>
                                    </div><span class="text-muted ms-3">43</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="text-nowrap me-3"><span
                                            class="d-inline-block text-muted align-middle">4</span><i
                                            class="ci-star-filled fs-xs ms-1"></i></div>
                                    <div class="w-100">
                                        <div class="progress" style="height: 4px;">
                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="27"
                                                class="progress-bar" role="progressbar"
                                                style="width: 27%; background-color: #a7e453;"></div>
                                        </div>
                                    </div><span class="text-muted ms-3">16</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="text-nowrap me-3"><span
                                            class="d-inline-block text-muted align-middle">3</span><i
                                            class="ci-star-filled fs-xs ms-1"></i></div>
                                    <div class="w-100">
                                        <div class="progress" style="height: 4px;">
                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="17"
                                                class="progress-bar" role="progressbar"
                                                style="width: 17%; background-color: #ffda75;"></div>
                                        </div>
                                    </div><span class="text-muted ms-3">9</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="text-nowrap me-3"><span
                                            class="d-inline-block text-muted align-middle">2</span><i
                                            class="ci-star-filled fs-xs ms-1"></i></div>
                                    <div class="w-100">
                                        <div class="progress" style="height: 4px;">
                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="9"
                                                class="progress-bar" role="progressbar"
                                                style="width: 9%; background-color: #fea569;"></div>
                                        </div>
                                    </div><span class="text-muted ms-3">4</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="text-nowrap me-3"><span
                                            class="d-inline-block text-muted align-middle">1</span><i
                                            class="ci-star-filled fs-xs ms-1"></i></div>
                                    <div class="w-100">
                                        <div class="progress" style="height: 4px;">
                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="4"
                                                class="progress-bar bg-danger" role="progressbar" style="width: 4%;">
                                            </div>
                                        </div>
                                    </div><span class="text-muted ms-3">2</span>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-3">

                        <!-- Reviews -->
                        <div class="row py-3">
                            <!-- Reviews list-->
                            <div class="col-md-7">
                                <div class="d-flex justify-content-end pb-4">
                                    <div class="d-flex align-items-center flex-nowrap">
                                        <label class="fs-sm text-muted text-nowrap me-2 d-none d-sm-block"
                                            for="sort-reviews">Sort by:</label>
                                        <select class="form-select-sm form-select" id="sort-reviews">
                                            <option>Newest</option>
                                            <option>Oldest</option>
                                            <option>Popular</option>
                                            <option>High rating</option>
                                            <option>Low rating</option>
                                        </select>
                                    </div>
                                </div>

                                @forelse ($reviews ??[] as $review)
                                    <!-- Review-->
                                    <div class="product-review border-bottom mb-4 pb-4">
                                        <div class="d-flex mb-3">
                                            <div class="d-flex align-items-center me-4 pe-2">
                                                <img alt="{{ $review->user->name }}" class="rounded-circle"
                                                    src="{{ asset('app') }}/img/shop/reviews/01.jpg" width="50">
                                                <div class="ps-3">
                                                    <h6 class="fs-sm mb-0">{{ $review->user->name }}</h6><span
                                                        class="fs-ms text-muted">{{ $review->created_at->format('D, M d, Y') }}</span>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="star-rating">
                                                    <i class="star-rating-icon ci-star-filled active"></i>
                                                    <i class="star-rating-icon ci-star-filled active"></i>
                                                    <i class="star-rating-icon ci-star-filled active"></i>
                                                    <i class="star-rating-icon ci-star-filled active"></i>
                                                    <i class="star-rating-icon ci-star"></i>
                                                </div>
                                                <div class="fs-ms text-muted">83% of users found this review
                                                    helpful
                                                </div>
                                            </div>
                                        </div>
                                        <p class="fs-md mb-2">{{ $review->body }}</p>
                                        <ul class="list-unstyled fs-ms pt-1">
                                            <li class="mb-1">
                                                <span class="fw-medium">Pros:&nbsp;</span>
                                                Consequuntur magni, voluptatem sequi, tempora
                                            </li>
                                            <li class="mb-1">
                                                <span class="fw-medium">Cons:&nbsp;</span>
                                                Architecto beatae, quis autem
                                            </li>
                                        </ul>
                                        <div class="text-nowrap">
                                            <button class="btn-like" type="button">15</button>
                                            <button class="btn-dislike" type="button">3</button>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                                <div class="text-center">
                                    <button class="btn btn-outline-accent" type="button">
                                        <i class="ci-reload me-2"></i>Load more reviews
                                    </button>
                                </div>
                            </div>

                            <!-- Leave review form-->
                            <div class="col-md-5 mt-md-0 pt-md-0 mt-2 pt-4">
                                <livewire:review::guest.create :reviewable="$product" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product description-->
    <div class="container pt-lg-3 pb-4 pb-sm-5 d-none">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="h3 pb-2">Choose your style</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                    voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                    cupidatat non proident.</p><img src="{{ asset('app') }}/img/shop/single/prod-img2.jpg"
                    alt="Product description">
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                    laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                    architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                    aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione
                    voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet,
                    consectetur, adipisci velit, sed quia non numquam eius modi tempora.</p>
            </div>
        </div>
    </div>

    <hr class="mb-3">

    {{-- @forelse ($stock->variants ?? [] as $stock_variant)
        @dd($stock_variant) --}}
    <!-- Product carousel (Other Variants)-->
    <livewire:product::related-variants :stock="$stock" />
    {{-- @empty
    @endforelse --}}

    <!-- Product carousel (You may also like)-->
    <div class="container pt-lg-2 pb-5 mb-md-3 d-none hidden">
        <h2 class="h3 text-center pb-4">You may also like</h2>

        <div class="tns-carousel tns-controls-static tns-controls-outside">
            <div class="tns-carousel-inner"
                data-carousel-options="{&quot;items&quot;: 2, &quot;controls&quot;: true, &quot;nav&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;768&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;items&quot;:4, &quot;gutter&quot;: 30}}}">
                <!-- Product-->
                <div>
                    <div class="card product-card card-static">
                        <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip"
                            data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a
                            class="card-img-top d-block overflow-hidden" href="javascript://"><img
                                src="{{ asset('app') }}/img/shop/catalog/66.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"
                                href="javascript://">Smartwatches</a>
                            <h3 class="product-title fs-sm"><a href="javascript://">Health &amp; Fitness Smartwatch</a></h3>
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent">$250.<small>00</small></span>
                                </div>
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
                        <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip"
                            data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a
                            class="card-img-top d-block overflow-hidden" href="javascript://"><img
                                src="{{ asset('app') }}/img/shop/catalog/67.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"
                                href="javascript://">Smartwatches</a>
                            <h3 class="product-title fs-sm"><a href="javascript://">Heart Rate &amp; Activity Tracker</a>
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
                        <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip"
                            data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a
                            class="card-img-top d-block overflow-hidden" href="javascript://"><img
                                src="{{ asset('app') }}/img/shop/catalog/64.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"
                                href="javascript://">Smartwatches</a>
                            <h3 class="product-title fs-sm"><a href="javascript://">Smart Watch Series 5, Aluminium</a></h3>
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
                        <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip"
                            data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i></button><a
                            class="card-img-top d-block overflow-hidden" href="javascript://"><img
                                src="{{ asset('app') }}/img/shop/catalog/68.jpg" alt="Product"></a>
                        <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"
                                href="javascript://">Smartwatches</a>
                            <h3 class="product-title fs-sm"><a href="javascript://">Health &amp; Fitness Smartwatch</a></h3>
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
                            <h3 class="product-title fs-sm"><a href="javascript://">Heart Rate &amp; Activity Tracker</a>
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
            </div>
        </div>
    </div>

    <!-- Product bundles carousel (Cheaper together)-->
    <div class="container pt-lg-1 pb-5 mb-md-3 d-none hidden">
        <div class="card card-body pt-5">
            <h2 class="h3 text-center pb-4">Cheaper together</h2>

            <div class="tns-carousel">
                <div class="tns-carousel-inner"
                    data-carousel-options="{&quot;items&quot;: 1, &quot;controls&quot;: false, &quot;nav&quot;: true}">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-md-3 col-sm-5">
                                <div class="card product-card card-static text-center mx-auto"
                                    style="max-width: 20rem;"><a class="card-img-top d-block overflow-hidden"
                                        href="javascript://"><img src="{{ asset('app') }}/img/shop/catalog/70.jpg"
                                            alt="Product"></a>
                                    <div class="card-body py-2"><span
                                            class="d-inline-block bg-secondary fs-ms rounded-1 py-1 px-2 mb-3">Your
                                            product</span>
                                        <h3 class="product-title fs-sm"><a href="javascript://">Smartwatch Youth Edition</a>
                                        </h3>
                                        <div class="product-price text-accent">$124.<small>99</small></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 col-sm-2 text-center">
                                <div class="display-4 fw-light text-muted px-4">+</div>
                            </div>

                            <div class="col-md-3 col-sm-5">
                                <div class="card product-card card-static text-center mx-auto"
                                    style="max-width: 20rem;"><a class="card-img-top d-block overflow-hidden"
                                        href="javascript://"><img src="{{ asset('app') }}/img/shop/catalog/72.jpg"
                                            alt="Product"></a>
                                    <div class="card-body py-2"><span
                                            class="d-inline-block bg-danger fs-ms text-white rounded-1 py-1 px-2 mb-3">-20%</span>
                                        <h3 class="product-title fs-sm"><a href="javascript://">Smartwatch Wireless
                                                Charger</a></h3>
                                        <div class="product-price"><span
                                                class="text-accent">$16.<small>00</small></span>
                                            <del class="fs-sm text-muted">$20.<small>00</small></del>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-none d-md-block col-md-1 text-center">
                                <div class="display-4 fw-light text-muted px-4">=</div>
                            </div>

                            <div class="col-md-4 pt-3 pt-md-0">
                                <div class="bg-secondary p-4 rounded-3 text-center mx-auto" style="max-width: 20rem;">
                                    <div class="h3 fw-normal text-accent mb-3 me-1">$140.<small>99</small></div>
                                    <button class="btn btn-primary" type="button">Purchase together</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="row align-items-center">
                            <div class="col-md-3 col-sm-5">
                                <div class="card product-card card-static text-center mx-auto"
                                    style="max-width: 20rem;"><a class="card-img-top d-block overflow-hidden"
                                        href="javascript://"><img src="{{ asset('app') }}/img/shop/catalog/70.jpg"
                                            alt="Product"></a>
                                    <div class="card-body py-2"><span
                                            class="d-inline-block bg-secondary fs-ms rounded-1 py-1 px-2 mb-3">Your
                                            product</span>
                                        <h3 class="product-title fs-sm"><a href="javascript://">Smartwatch Youth Edition</a>
                                        </h3>
                                        <div class="product-price text-accent">$124.<small>99</small></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 col-sm-2 text-center">
                                <div class="display-4 fw-light text-muted px-4">+</div>
                            </div>

                            <div class="col-md-3 col-sm-5">
                                <div class="card product-card card-static text-center mx-auto"
                                    style="max-width: 20rem;"><a class="card-img-top d-block overflow-hidden"
                                        href="javascript://"><img src="{{ asset('app') }}/img/shop/catalog/71.jpg"
                                            alt="Product"></a>
                                    <div class="card-body py-2"><span
                                            class="d-inline-block bg-danger fs-ms text-white rounded-1 py-1 px-2 mb-3">-15%</span>
                                        <h3 class="product-title fs-sm"><a href="javascript://">Bluetooth Headset Air
                                                (White)</a></h3>
                                        <div class="product-price"><span
                                                class="text-accent">$59.<small>00</small></span>
                                            <del class="fs-sm text-muted">$69.<small>00</small></del>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-none d-md-block col-md-1 text-center">
                                <div class="display-4 fw-light text-muted px-4">=</div>
                            </div>

                            <div class="col-md-4 pt-3 pt-md-0">
                                <div class="bg-secondary p-4 rounded-3 text-center mx-auto" style="max-width: 20rem;">
                                    <div class="h3 fw-normal text-accent mb-3 me-1">$183.<small>99</small></div>
                                    <button class="btn btn-primary" type="button">Purchase together</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- </x-app-layout> --}}
