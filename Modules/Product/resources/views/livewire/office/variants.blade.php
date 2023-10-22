<div>
    @if ($display == 'grid')
        <div class="row mx-n2">
            @forelse ($product->variants ?? [] as $variant)
                <!-- Product variants-->
                <div class="col-lg-4 col-md-4 col-sm-6 mb-3 px-2" x-data="{ variant: @js($variant->id) }">
                    <div class="card product-card">
                        {{-- Action Buttons --}}
                        <div class="product-card-actions">
                            {{-- Submenu --}}
                            <ul class="nav justify-content-end">
                                <li class="nav-item">
                                    {{-- Stock --}}
                                    @can('products.variants.stock')
                                        <a href="javascript://stock"
                                            class="btn btn-sm text-success border border-light shadow rounded"
                                            title="Add to Stock" data-bs-toggle="tooltip">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    @endcan
                                </li>
                                <li class="nav-item">
                                    {{-- Edit --}}
                                    @can('products.variants.edit')
                                        <a href="javascript://edit"
                                            class="btn btn-sm text-success border border-light shadow rounded edit-variant"
                                            title="Edit" data-bs-toggle="tooltip"
                                            wire:click="$dispatch('variant_edit', @js($variant->id))">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                </li>
                                <li class="nav-item">
                                    {{-- Copy --}}
                                    @can('products.variants.create')
                                        <a href="javascript://copy"
                                            class="btn btn-sm text-success border border-light shadow rounded copy-variant"
                                            title="Copy" data-bs-toggle="tooltip"
                                            wire:click="$dispatch('variant_edit', @js($variant->id))">
                                            <i class="fas fa-copy"></i>
                                        </a>
                                    @endcan
                                </li>
                                <li class="nav-item">
                                    {{-- Delete --}}
                                    @can('products.variants.delete')
                                        <a href="javascript://delete"
                                            class="btn btn-sm text-danger border border-light shadow rounded text-bg-danger delete-variant"
                                            title="Delete" data-bs-toggle="tooltip"
                                            wire:click="$dispatch('variant_edit', @js($variant->id))">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endcan
                                </li>
                            </ul>
                        </div>

                        {{-- Variant Image --}}
                            <a class="d-block justify-content-center justify-content-sm-between align-items-center overflow-hidden align-middle"
                                href="javascript://{{ route('office.product.variant.show', ['variant' => $variant->id]) }}"
                                style="height:100%;">
                        <figure class="card-img-top mb-0" style="max-height: 275px; height: 275px;">
                                @if ($variant->hasMedia(['image']))
                                    {{-- @foreach ($variant->media as $i) --}}
                                    <img src="{{ $variant->media->first()->getUrl() }}" class="d-block m-auto rounded"
                                        alt="{{ $variant->name ?? $variant->product->name }}"
                                        style="max-height: 275px;" />
                                    {{-- @endforeach --}}
                                @else
                                    <img src="{{ asset('app') }}/img/shop/catalog/01.jpg" alt="{{ $variant->name }}"
                                        style="max-height: 275px; height: 275px;" />
                                @endif
                        </figure>
                            </a>

                        <div class="card-body mt-2 py-0">
                            {{-- Tags --}}
                            {{-- <a class="product-meta _d-block fs-xs pb-1" href="javascript://filter-brand"
                                data-bs-toggle="tooltip" title="Brand">
                                @if (isset($variant->product->brand))
                                    {!! $variant->product->brand->name !!}
                                @else
                                    ...
                                @endif
                            </a> --}}

                            {{-- Title --}}
                            <h3 class="product-title fs-sm mb-1">
                                <a href="javascript://{{ route('office.product.variant.show', ['variant' => $variant->id]) }}"
                                    data-bs-toggle="tooltip" title="Title">
                                    {!! $variant->name ?? $variant->product->name !!}
                                </a>
                            </h3>

                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                {{-- Price --}}
                                <div class="product-price">
                                    <span class="text-accent" data-bs-toggle="tooltip" title="Price">
                                        @if ($variant->price)
                                            @php
                                                $amount = explode('.', $variant->price->amount);
                                            @endphp

                                            <span>{{ setting('currency', 'NGN') }}</span>
                                            <span><span>{{ $amount[0] }}.</span><small>{{ $amount[1] }}</small></span>
                                        @else
                                            <span>{{ setting('currency', 'NGN') }}</span>
                                            <span><span>0.</span><small>00</small></span>
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

                            <ul class="list-group list-group-flush mb-2_">
                                {{-- Size --}}
                                <li class="list-group-item p-0 pb-1">
                                    <span data-bs-toggle="tooltip" title="Size">{{ $variant->size ?? '0.00' }}</span>
                                    <span data-bs-toggle="tooltip"
                                        title="Unit of measurement - {{ $variant->unit->name ?? '?' }}">
                                        {{ $variant->unit->code ?? '' }}
                                    </span>
                                </li>
                            </ul>

                            {{-- Size --}}
                            <div class="text-muted fw-normal small">
                                <span data-bs-toggle="tooltip" title="Size">
                                    {{-- {{ $variant->variant->size }} --}}
                                </span>
                                {{-- <span data-bs-toggle="tooltip" title="{{ $variant->variant->unit->name }}">
                                    {{ $variant->variant->unit->code }}
                                </span> --}}
                            </div>
                        </div>

                        <div class="card-body card-body-hidden d-none_">
                            @if ($variant->barcode)
                                {{-- Attributes --}}
                                <ul class="list-group list-group-flush mb-2">
                                    @if ($variant->barcode)
                                        {{-- Barcode --}}
                                        <li class="list-group-item px-0">
                                            <i class="fas fa-barcode pe-1"></i>
                                            <span data-bs-toggle="tooltip"
                                                title="Barcode number">{{ $variant->barcode }}</span>
                                        </li>
                                    @endif

                                    {{-- <li class="list-group-item">...
                                </li>
                                <li class="list-group-item">Second item</li>
                                <li class="list-group-item">Third item</li> --}}
                                </ul>
                            @endif

                            {{-- Size attributes --}}
                            {{-- <div class="pb-2 text-center">
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
                            </div> --}}

                            {{-- Quick view --}}
                            <div class="mb-2 text-center">
                                <a class="nav-link-style fs-ms" href="javascript://#quick-view" data-bs-toggle="modal">
                                    <i class="ci-eye me-1 align-middle"></i>
                                    Quick view
                                </a>
                            </div>

                            {{-- Add to stock --}}
                            <button class="btn btn-primary btn-sm d-block w-100" type="button">
                                <i class="ci-cart fs-sm me-1"></i>
                                Add to Stock
                            </button>
                        </div>
                    </div>

                    <hr class="d-sm-none">
                </div>
            @empty
                <p class="py-5 text-center">
                    ... no product variants found.
                </p>
            @endforelse
        </div>

        @if ($product->variants->count())
            <hr class="my-3">

            {{-- {{ $product->variants->links() }} --}}
        @endif
    @else
    @endif

    {{-- @push('js')
        <script>
            // document.addEventListener('livewire:init', function() {
            //     $(function() {
            //         // alert("Hi")
            //     });
            // })
        </script>
    @endpush --}}
</div>
