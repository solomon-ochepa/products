<div wire:ignore.self class="modal fade modal-quick-view" id="variant-modal" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true" tabindex="-1">
    {{-- Do your work, then step back. --}}

    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title product-title">
                    @if ($product or optional($variant)->id)
                        {!! Str::limit(optional($variant->product)->name ?? $product->name, 24) !!}
                        <i class="ci-arrow-right fs-lg ms-2"></i>
                    @endif

                    <i class="fas {{ isset($variant->id) ? 'fa-edit' : 'fa-plus' }} icon me-1"></i>
                    <span id="variant-title">
                        @if (isset($variant->id) and $variant->name)
                            {{ $variant->name }}
                        @else
                            Variant
                        @endif
                    </span>
                </h4>

                <span>
                    <button class="btn btn-sm" type="button" aria-label="Refresh" wire:click="$dispatch('refresh')">
                        <i class="fas fa-refresh"></i>
                    </button>

                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </span>
            </div>

            <div class="modal-body">
                <!-- Tabs-->
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active px-0" href="#add" data-bs-toggle="tab" role="tab">
                            <div class="d-none d-sm-block"><i class="ci-user me-2 opacity-60"></i>Add</div>
                            <div class="d-sm-none text-center">
                                <i class="ci-user d-block fs-xl mb-2 opacity-60"></i>
                                <span class="fs-ms">Add</span>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled px-0" disabled href="#generate" data-bs-toggle="tab" role="tab">
                            <div class="d-none d-sm-block"><i class="ci-settings me-2 opacity-60"></i>Generate</div>
                            <div class="d-sm-none text-center">
                                <i class="ci-settings d-block fs-xl mb-2 opacity-60"></i>
                                <span class="fs-ms">Generate</span>
                            </div>
                        </a>
                    </li>
                </ul>

                <!-- Tab content-->
                <div class="tab-content">
                    <!-- Add Variates -->
                    <div class="tab-pane fade show active" id="add" role="tabpanel">
                        <form x-data wire:submit="save" enctype="multipart/form-data" class="needs-validation"
                            novalidate>
                            <div class="row">
                                <div class="col-md-3">
                                    <div x-data="{ file: null, image: @js($image ?? null), imageUrl: null }" class="col-span-6 ms-2 sm:col-span-4 md:mr-3">
                                        <!-- Photo File Input -->
                                        <input type="file" class="d-none hidden" id="photo" x-ref="photo"
                                            wire:model.live="photo"
                                            @change="
                                        file = $refs.photo.files[0];

                                        const reader = new FileReader();
                                        reader.readAsDataURL(file);
                                        reader.onload = (e) => {
                                            imageUrl = e.target.result;
                                        };">

                                        <div class="text-center">
                                            <template x-if="imageUrl">
                                                <img :src="imageUrl"
                                                    class="_rounded-full _object-cover m-auto h-40 w-40 rounded shadow"
                                                    style="max-height: 300px;">
                                            </template>

                                            <template x-if="! imageUrl">
                                                <div class="_rounded-full _object-cover m-auto h-40 w-40 rounded bg-gray-100 shadow"
                                                    style="width: 100px; height: 100px;"></div>
                                            </template>

                                            <button type="button"
                                                class="focus:shadow-outline-blue mt-2 ms-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-400 focus:outline-none active:bg-gray-50 active:text-gray-800"
                                                @click.prevent="$refs.photo.click()">
                                                Select New Photo
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <x-alert />

                                    <div class="row gy-md-3 gy-3 pb-md-0 pb-2">
                                        {{-- Title --}}
                                        <div class="col-sm-12">
                                            {{-- <label class="form-label" for="variant-name">Title</label> --}}
                                            <div class="input-group">
                                                <span class="input-group-text" id="variant-name-icon">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <input type="text" id="variant-name" class="form-control"
                                                    placeholder="Name" aria-label="Name"
                                                    aria-describedby="variant-name-icon" title="Name"
                                                    data-bs-toggle="tooltip" wire:model.blur="variant.name" />
                                            </div>
                                        </div>

                                        {{-- Barcode --}}
                                        <div class="col-sm-12">
                                            {{-- <label class="form-label" for="barcode">Barcode</label> --}}
                                            <div class="input-group">
                                                <span class="input-group-text" id="barcode-icon">
                                                    <i class="fas fa-barcode"></i>
                                                </span>
                                                <input type="text" name="barcode" id="barcode"
                                                    class="form-control" placeholder="Barcode" aria-label="Barcode"
                                                    aria-describedby="barcode-icon" title="Barcode"
                                                    data-bs-toggle="tooltip" wire:model.blur="variant.barcode" />
                                            </div>
                                        </div>

                                        {{-- Measurements --}}
                                        <div class="col-sm-12">
                                            <h3 class="h6 border-bottom mb-0">Measurements</h3>
                                        </div>

                                        {{-- Size --}}
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-text" id="size-icon">
                                                    <i class="fas fa-ruler-combined"></i>
                                                </span>
                                                <input type="number" class="form-control" id="size"
                                                    placeholder="0.00" step="0.01" min="0.00"
                                                    aria-label="Size" aria-describedby="size-icon" title="Size"
                                                    data-bs-toggle="tooltip" wire:model.blur="variant.size" />
                                            </div>
                                        </div>

                                        {{-- Unit --}}
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-text" id="unit-icon">
                                                    <i class="fas fa-weight-scale"></i>
                                                </span>
                                                <select id="unit" class="form-select" aria-label="Unit"
                                                    aria-describedby="unit-icon" title="Unit of Measurement"
                                                    data-bs-toggle="tooltip" wire:model.blur="variant.unit_code">
                                                    <option value="">Unit ?</option>
                                                    @foreach ($product->measurables ?? [] as $measurable)
                                                        <option value="{{ $measurable->unit->code }}"
                                                            title="{{ $measurable->unit->description ?? '' }}">
                                                            {{ $measurable->unit->code }} &middot;
                                                            {{ $measurable->unit->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Attributes --}}
                                        @livewire('product::office.variant.attributes', ['variant' => $variant], key($variant->id))
                                        <x-product::office.variant.attribute.create :options="$options"
                                            :i="$i" />
                                    </div>

                                    <!-- Submit-->
                                    <div class="pt-2">
                                        <button class="btn btn-lg btn-accent d-block w-100 submit" type="submit">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Generate --}}
                    <div class="tab-pane fade" id="generate" role="tabpanel">
                        <section class="row">
                            <div class="col-md-4">
                                <div class="accordion" id="attributables">
                                    @foreach ($product->attributables ?? [] as $key => $attributable)
                                        {{-- {{ dd($attributable) }} --}}
                                        <div class="accordion-item" wire:key="attributable-{{ $attributable->id }}">
                                            <h3 class="accordion-header fw-bold rounded-top bg-secondary bg-gradient"
                                                id="attributable-{{ $attributable->id }}-header">
                                                <button class="accordion-button {{ $key == 0 ?: ' collapsed' }}"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse_attributable_{{ $attributable->id }}"
                                                    aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                                                    aria-controls="collapse_attributable_{{ $attributable->id }}">
                                                    <span class="me-3" title="Name" data-bs-toggle="tooltip">
                                                        <span
                                                            class="ms-1">{{ $attributable->attribute->name }}</span>
                                                    </span>
                                                </button>
                                            </h3>

                                            <div id="collapse_attributable_{{ $attributable->id }}"
                                                class="accordion-collapse {{ $key == 0 ? 'show' : '' }} collapse"
                                                aria-labelledby="attributable-{{ $attributable->id }}-header"
                                                data-bs-parent="#attributables">
                                                <div class="accordion-body p-3">
                                                    <div class="row gy-3 pb-md-0 pb-2">
                                                        <div class="col-sm-12">
                                                            <ul class="list-group list-group-flush">
                                                                @foreach ($attributable->options as $attributable->option)
                                                                    <li class="list-group-item">
                                                                        <input class="form-check-input me-1"
                                                                            type="checkbox"
                                                                            value="{{ $attributable->option->id }}"
                                                                            id="option-{{ $attributable->option->id }}">
                                                                        <label class="form-check-label"
                                                                            for="firstCheckbox">{{ $attributable->option->name }}</label>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-8">
                                ...generate
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('variant:edit', function() {
                $(function() {
                    $('#variant-modal #photo').attr('src', '')
                    $('#variant-modal').modal('show')
                })
            })
        </script>
    @endpush
</div>
