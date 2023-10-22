<div class="col-sm-3 mb-grid-gutter">
    <div vocab="https://schema.org/" typeof="Product" class="card product-card-alt">
        <div class="product-thumb" style="height: 200px;">
            {{-- Wishlist --}}
            @livewire('like::like', ['likeable_type' => get_class($stock), 'likeable_id' => $stock->id, ['class' => 'btn-wishlist btn-sm opacity-60 hover:opacity-80']])

            <!-- Action buttons -->
            <div class="product-card-actions">
                <a class="btn btn-light btn-icon btn-shadow fs-base mx-2 opacity-60 hover:opacity-25"
                    href="{{ route('stock.show', $query) }}" title="View details" data-bs-toggle="tooltip">
                    <i class="ci-eye"></i>
                </a>

                <button class="btn btn-light btn-icon btn-shadow fs-base mx-2 opacity-60 hover:opacity-100"
                    type="button" title="Add to Cart" data-bs-toggle="tooltip">
                    <i class="ci-cart"></i>
                </button>
            </div>

            <a class="product-thumb-overlay" href="{{ route('stock.show', $query) }}"></a>
            <img property="image" src="{{ $image }}" alt="{{ $stock->title }}"
                style="height: auto; max-height: 100%" />
        </div>

        <div class="card-body">
            <!-- Title -->
            <h3 property="name" class="product-title fs-sm">
                <a href="{{ route('stock.show', $query) }}">
                    @if ($stock->title)
                        <div class="text-muted fs-sm">
                            <span class="product-meta fw-bold">{!! $stock->title !!}</span>
                        </div>
                    @endif

                    <span class="d-block">{!! $stock->product->name !!}</span>
                </a>

                <div class="d-flex flex-wrap justify-content-between align-items-center mt-1">
                    <!-- Price -->
                    <div class="text-muted fs-xs mt-2">
                        <span aria-label="Currency" title="Currency"
                            data-bs-toggle="tooltip">{{ currency('NGN', 'NGN') }}</span>
                        <span aria-label="Price" title="Price" data-bs-toggle="tooltip">{{ $price }}</span>
                    </div>

                    <!-- Size -->
                    @if ($stock->variant->size)
                        <div class="text-muted fs-xs mt-2">
                            <span aria-label="Size" title="Size"
                                data-bs-toggle="tooltip">{{ $stock->variant->size }}</span>
                            @if ($stock->variant->unit)
                                <span aria-label="{{ $stock->variant->unit->name }}"
                                    title="{{ $stock->variant->unit->name }}"
                                    data-bs-toggle="tooltip">{{ $stock->variant->unit->code }}</span>
                            @endif
                        </div>
                    @endif

                    <!-- Stocked -->
                    <div class="text-muted fs-xs me-2" aria-label="Stocked" title="Stock" data-bs-toggle="tooltip">
                        <i class="fas fa-gift text-muted _me-1"></i>
                        {{ $stocked }}
                        {{-- <span class="fs-xs ms-1">Businesses</span> --}}
                    </div>
                </div>
            </h3>

            {{-- Stats --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-1">
                <!-- Sales -->
                {{-- <div class="fs-xs me-2" aria-label="Sales" title="Sales"
                    data-bs-toggle="tooltip">
                    <i class="fas fa-shopping-cart text-muted _me-1"></i>
                    ...
                    <span class="fs-xs ms-1">Sales</span>
                </div> --}}

                {{-- <!-- Stocked -->
                <div class="fs-xs me-2" aria-label="Stocked" title="Stock" data-bs-toggle="tooltip">
                    <i class="fas fa-gift text-muted _me-1"></i>
                    {{ ($stocked = ceil($stock->stocked)) > 0 ? $stocked : '...' }}
                    <span class="fs-xs ms-1">Businesses</span>
                </div> --}}

                {{-- <div property="offers" typeof="Offer"
                    class="bg-faded-accent text-accent rounded-1 py-1 px-2">
                    <span property="priceCurrency" content="NGN">N</span>
                    <span property="price" content="0.00">
                        0.<small>00</small>
                    </span>
                </div> --}}
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

                {{-- <div class="text-muted fs-xs me-1">
                                                            <span class="product-meta fw-medium" aria-label="Rated by"
                                                                title="Rated by" data-bs-toggle="tooltip">(100)</span>
                                                        </div> --}}

                <div class="text-muted fs-xs" aria-label="Likes" title="Likes" data-bs-toggle="tooltip">
                    <span class="">
                        <i class="fas fa-thumbs-up"></i>
                        100
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
