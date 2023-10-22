<div>
    @if ($display == 'grid')
        <div class="row mx-n2">
            @forelse ($products ?? [] as $product)
                {{-- @dd($product) --}}
                <!-- Product-->
                <div class="col-md-4 col-sm-6 mb-3 px-2" x-data="{ product: @js($product->slug) }">
                    <div class="card product-card">
                        {{-- <button class="product-card-actions btn-sm" type="button" title="Edit" data-bs-toggle="modal"
                            data-bs-target="#edit-stock" x-on:click="$wire.dispatch('edit_stock', stock_id)">
                            <i class="fas fa-edit"></i>
                        </button> --}}
                        <a href="javascript://" class="product-card-actions btn-sm" title="Add to Stock"
                            data-bs-toggle="tooltip">
                            <i class="fas fa-square-plus"></i>
                        </a>

                        {{-- Image --}}
                        <figure class="card-img-top mb-0" style="max-height: 275px; height: 275px;">
                            <a href="{{ route('office.product.show', ['product' => $product->slug]) }}"
                                class="d-block my-auto overflow-hidden align-middle" style="height:100%;">
                                @if ($product->hasMedia(['image']))
                                    {{-- @foreach ($product->media as $i) --}}
                                    <img src="{{ $product->media->first()->getUrl() }}" class="d-block mx-auto rounded"
                                        alt="{{ $product->name }}" style="max-height: 275px;" />
                                    {{-- @endforeach --}}
                                @else
                                    <img src="{{ asset('app') }}/img/shop/catalog/01.jpg" alt="{{ $product->name }}"
                                        style="max-height: 275px; height: 275px;" />
                                @endif
                            </a>
                        </figure>

                        <div class="card-body py-2">
                            {{-- Tags --}}
                            <a class="product-meta _d-block fs-xs pb-1" href="javascript://filter-brand"
                                data-bs-toggle="tooltip" title="Brand">
                                @if (isset($product->brand))
                                    {!! $product->brand->name !!}
                                @else
                                    ...
                                @endif
                            </a>

                            {{-- Title --}}
                            <h3 class="product-title fs-sm mb-1">
                                @php
                                    $query = [];
                                @endphp
                                <a href="{{ route('office.product.show', array_merge(['product' => $product->slug], $query ?? [])) }}"
                                    data-bs-toggle="tooltip" title="Title">
                                    {!! $product->name !!}
                                </a>
                            </h3>

                            <div class="d-flex justify-content-center align-items-center">
                                {{-- Price --}}
                                <div class="product-price">
                                    <span class="text-accent" data-bs-toggle="tooltip" title="Price">
                                        @if ($product->price)
                                            @php
                                                $amount = explode('.', $product->price->amount);
                                            @endphp

                                            {{ setting('currency', 'NGN') }}
                                            {{ $amount[0] }}.<small>{{ $amount[1] }}</small>
                                        @else
                                            {{ setting('currency', 'NGN') }} 0.<small>00</small>
                                        @endif
                                    </span>

                                    {{-- <br /> --}}
                                </div>

                                {{-- Ratings --}}
                                <div class="star-rating" data-bs-toggle="tooltip" title="Ratings">
                                    {{-- <i class="star-rating-icon ci-star-filled active"></i> --}}
                                    <i class="star-rating-icon ci-star"></i>
                                    <i class="star-rating-icon ci-star"></i>
                                    <i class="star-rating-icon ci-star"></i>
                                    <i class="star-rating-icon ci-star"></i>
                                    <i class="star-rating-icon ci-star"></i>
                                </div>
                            </div>

                            {{-- Size --}}
                            <div class="text-muted fw-normal small">
                                <span data-bs-toggle="tooltip" title="Size">
                                    {{-- {{ $product->variant->size }} --}}
                                </span>
                                {{-- <span data-bs-toggle="tooltip" title="{{ $product->variant->unit->name }}">
                                    {{ $product->variant->unit->code }}
                                </span> --}}
                            </div>
                        </div>

                        <div class="card-body card-body-hidden d-none">
                            {{-- Size attributes --}}
                            <div class="pb-2 text-center">
                                <div class="form-check form-option form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="size1" id="s-75">
                                    <label class="form-option-label" for="s-75">7.5</label>
                                </div>
                                <div class="form-check form-option form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="size1" id="s-80"
                                        checked>
                                    <label class="form-option-label" for="s-80">8</label>
                                </div>
                                <div class="form-check form-option form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="size1" id="s-85">
                                    <label class="form-option-label" for="s-85">8.5</label>
                                </div>
                                <div class="form-check form-option form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="size1" id="s-90">
                                    <label class="form-option-label" for="s-90">9</label>
                                </div>
                            </div>

                            {{-- Add to cart --}}
                            <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button">
                                <i class="ci-cart fs-sm me-1"></i>
                                Add to Cart
                            </button>

                            {{-- Quick view --}}
                            <div class="text-center">
                                <a class="nav-link-style fs-ms" href="javascript://#quick-view" data-bs-toggle="modal">
                                    <i class="ci-eye me-1 align-middle"></i>
                                    Quick view
                                </a>
                            </div>
                        </div>
                    </div>

                    <hr class="d-sm-none">
                </div>
            @empty
                <p class="py-5 text-center">
                    ... no products found.
                </p>
            @endforelse
        </div>

        @isset($products)
            <hr class="my-3">

            {{ $products->links() }}
        @endisset
    @else
    @endif
</div>
