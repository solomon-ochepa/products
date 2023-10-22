<section wire:ignore class="col-md-8">
    <!-- Details-->
    <div class="mb-md-5 mb-4 pb-md-0 pb-2">
        <x-alert />

        <form x-data wire:submit="update" class="needs-validation" novalidate>
            {{-- <h2 class="h5 mb-3">Details</h2> --}}
            <div class="row gy-md-4 gy-3">
                {{-- Title --}}
                <div class="col-12 mt-4">
                    <label class="form-label" for="product-title">
                        Title<span class="ms-1 text-danger">*</span>
                    </label>
                    <input type="text" class="form-control fw-bold" id="product-title" value="{{ $product->name }}"
                        placeholder="Product title" wire:model.blur="product.name" required />
                    <div class="invalid-feedback">Please, enter the title.</div>
                </div>

                {{-- Subtitle --}}
                <div class="col-12 mt-2">
                    <label class="form-label" for="product-subtitle">
                        Subtitle
                    </label>
                    <input type="text" class="form-control form-control-sm" id="product-subtitle"
                        value="{{ $product->subtitle }}" placeholder="Product subtitle"
                        wire:model.blur="product.subtitle" />
                    <div class="invalid-feedback">Please, enter the subtitle.</div>
                </div>

                {{-- Description --}}
                <div class="col-12">
                    <label class="form-label" for="product-description">Description</label>
                    <textarea class="form-control" id="product-description" rows="4"
                        placeholder="Enter a short description of your item" wire:model="product.description">{{ $product->description }}</textarea>
                    {{-- <span class="form-text">0 of 500 characters used.</span> --}}
                </div>

                {{-- Manufacturer --}}
                <div class="col-7">
                    <label class="form-label" for="product-manufacturer">
                        Manufacturer
                    </label>
                    <select class="form-select" id="product-manufacturer" wire:model="product.manufacturer_id">
                        <option value=null>Select option</option>
                        @foreach ($manufacturers ?? [] as $item)
                            <option @if ($item->id == ($product->manufacturer_id ?? null or $product->brand->manufacturer->id ?? null)) selected @endif value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                    {{-- <input class="form-control typeahead" id="product-manufacturer" type="text"
                    placeholder="Manufacturer"
                    value="{{ $product->manufacturer->name ?? ($product->brand->manufacturer->name ?? '') }}" /> --}}
                    <div class="invalid-feedback">Please, enter the title.</div>
                    {{-- <span class="form-text">Search product by title.</span> --}}
                </div>

                {{-- Brand --}}
                <div class="col-5">
                    <label class="form-label" for="brand">
                        Brand
                    </label>
                    <select wire:model="product.brand_id" class="form-select" id="product-brand">
                        <option value=null>Select option</option>
                        @foreach ($brands ?? [] as $item)
                            <option @if ($item->id == $product->brand_id ?? null) selected @endif value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please, enter the title.</div>
                    {{-- <span class="form-text">Select product by title.</span> --}}
                </div>

                {{-- <div class="col-sm-6">
                        <label class="form-label" for="category">Category</label>
                        <select class="form-select" id="category">
                            <option disabled selected>Choose category</option>
                            <option>Art</option>
                            <option>Photography</option>
                            <option>Music</option>
                            <option>Gaming</option>
                            <option>Sports</option>
                            <option>Collections</option>
                            <option>Utility</option>
                        </select>
                    </div> --}}

                {{-- <div class="col-sm-6">
                        <label class="form-label" for="collection">Add to collection</label>
                        <select class="form-select" id="collection">
                            <option disabled selected>Choose collection</option>
                            <option>Contemporary art collage</option>
                            <option>3D digital abstract art</option>
                            <option>Clone X Mini Monsters</option>
                            <option>Ocean and sky</option>
                            <option>Aesthetic art collage</option>
                        </select>
                    </div> --}}

                <!-- Submit-->
                <div class="mt-3 text-end">
                    <button class="btn _btn-sm btn-accent ms-auto _d-block _w-100" type="submit">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>

    <livewire:product.office.measurables :product="$product" />
</section>
