<div vocab="https://schema.org/" typeof="Product" class="card h-100 product-card-alt shadow-sm hover:shadow-sm">
    <div class="product-thumb"
        style="height: 200px;/* background: url({{ $image }}) center no-repeat; background-size: contain;*/">
        <img property="image" class="card-img-top h-100 -w-100 justify-self-center" src="{{ $image }}"
            alt="{{ $stock->title }}" style="-height: auto; -max-height: 100%" />

        {{-- Like --}}
        <livewire:like::like :data="[
            'likeable_type' => get_class($stock),
            'likeable_id' => $stock->id,
            'attributes' => [
                'class' => 'btn-wishlist btn-sm opacity-60 hover:opacity-80',
            ],
        ]" />

        <!-- Quick view & Add to Cart -->
        <div class="product-card-actions">
            <!-- Quick view -->
            <a class="btn btn-light btn-icon btn-shadow fs-base mx-2 opacity-60 hover:opacity-25"
                href="{{ route('product.show', $queries) }}" title="View details" data-bs-toggle="tooltip">
                <i class="ci-eye"></i>
            </a>

            <!-- Add to Cart -->
            <livewire:product::add-to-cart-icon :item="$stock ?? null" />
        </div>

        <a class="product-thumb-overlay" href="{{ route('product.show', $queries) }}"></a>
    </div>

    <div class="card-body px-2 pb-1">
        <!-- Title -->
        <h3 class="product-title fw-normal fs-sm pb-1 mb-0">
            @php
                $title = str_replace('-', '&RightArrow;', $stock->title);
            @endphp
            <a class="product-meta d-block" href="{{ route('product.show', $queries) }}" title="{!! $title !!}"
                data-bs-toggle="tooltip">
                {!! $title !!}
            </a>
        </h3>

        {{-- Price & Size --}}
        <div class="card-text mt-1" property="offers" typeof="Offer">
            @php
                $size = '';
                if ($stock->variant->size) {
                    $size = $stock->variant->size;

                    if ($stock->variant->unit) {
                        $size .= ' ' . $stock->variant->unit->code;
                    }
                }
            @endphp

            <meta property="name" content="{!! $stock->title . ($size ? ' &middot; ' . $size : '') !!}" />
            <meta property="offeredBy" content="{{ $stock->business->name ?? '' }}" />
            <meta property="availability" content="https://schema.org/InStock" />
            <meta property="priceValidUntil" datatype="xsd:date" content="{{ now()->endOfMonth() }}" />
            <meta rel="url" resource="{{ route('product.show', $queries) }}" />
            <meta property="itemCondition" content="https://schema.org/NewCondition" />

            <div property="priceSpecification" typeof="UnitPriceSpecification"
                class="d-flex flex-wrap justify-content-between align-items-center">
                <!-- Price -->
                <div class="text-muted fs-xs -mt-2">
                    <span property="priceCurrency" content="{{ currency('NGN', 'NGN') }}" aria-label="Currency"
                        title="Currency: Nigeria Naira" data-bs-toggle="tooltip">{{ currency('NGN', 'N') }}</span>

                    <span property="price" content="{{ $price }}" aria-label="Price" title="Price"
                        data-bs-toggle="tooltip">{{ $price }}</span>
                </div>

                <!-- Size -->
                @if ($stock->variant->size)
                    <div property="size" typeof="QuantitativeValue" class="text-muted fs-xs -mt-2">
                        <span property="value" aria-label="Size" title="Size"
                            data-bs-toggle="tooltip">{{ decimal_format($stock->variant->size) }}</span>
                        @if ($stock->variant->unit)
                            <span property="unitText" aria-label="{{ $stock->variant->unit->name }}"
                                title="Measurement unit: {{ $stock->variant->unit->name }}"
                                data-bs-toggle="tooltip">{{ $stock->variant->unit->code }}</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <section class="card-footer px-2">
        <!-- Rating -->
        <div property="aggregateRating" typeof="AggregateRating"
            class="d-flex flex-wrap justify-content-between align-items-start mt-1">
            <div class="text-muted fs-xs me-1">
                <span class="product-meta fw-medium" aria-label="Rates" title="Rates" data-bs-toggle="tooltip">
                    <span property="ratingValue">1</span>
                    <span>/</span>
                    <span>5</span>
                </span>
            </div>

            <div class="star-rating me-1" aria-label="Aggregate Rating" title="Rating" data-bs-toggle="tooltip">
                <i class="star-rating-icon ci-star-filled active"></i>
                <i class="star-rating-icon ci-star-filled active"></i>
                <i class="star-rating-icon ci-star-filled active"></i>
                <i class="star-rating-icon ci-star-filled active"></i>
                <i class="star-rating-icon ci-star-filled active"></i>
            </div>

            {{-- <div class="text-muted fs-xs me-1">
                    <span class="product-meta fw-medium" aria-label="Rated by"
                        title="Rated by" data-bs-toggle="tooltip">(100)</span>
                </div> --}}

            <div class="text-muted fs-xs" aria-label="Likes" title="Likes" data-bs-toggle="tooltip">
                <span class="">
                    <i class="fas fa-thumbs-up"></i>
                    <span property="ratingCount">1</span>
                </span>
            </div>
        </div>
    </section>
</div>
