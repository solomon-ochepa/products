<div wire:ignore.self class="modal fade modal-quick-view" id="add-attribute" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-hidden="true" tabindex="-1">
    <!-- Do your work, then step back. -->

    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title add-title">
                    Attributes
                    <i class="ci-arrow-right fs-lg ms-2"></i>
                </h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form x-data wire:submit="submit" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <x-alert />

                    <div class="accordion accordion-flush" id="add-attributes">
                        @foreach ($options ?? [] as $key => $option)
                            {{-- {{ dd($option) }} --}}
                            <div class="accordion-item" wire:key="add-attribute-{{ $key }}">
                                <h3 class="accordion-header fw-bold rounded-top bg-secondary bg-gradient"
                                    id="add-attribute-{{ $key }}-header">
                                    <button class="accordion-button {{ $key == 0 ?: ' collapsed' }}" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-add-attribute-{{ $key }}"
                                        aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse-add-attribute-{{ $key }}">
                                        <span class="me-3" title="Name" data-bs-toggle="tooltip">
                                            {{-- Delete button --}}
                                            @if ($key > 0)
                                                <a href="javascript://delete" class="col-auto fs-lg text-danger"
                                                    wire:click.prevent="remove(@js($key))">
                                                    <i class="fas fa-square-minus"></i>
                                                </a>
                                            @endif

                                            {{-- Name --}}
                                            <span class="ms-1">
                                                {{ strlen($option['name']) ? $option['name'] : 'Attribute: ' . ($key + 1) }}
                                            </span>
                                        </span>
                                    </button>
                                </h3>

                                <div id="collapse-add-attribute-{{ $key }}"
                                    class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                                    aria-labelledby="add-attribute-{{ $key }}-header"
                                    data-bs-parent="#add-attributes">
                                    <div class="accordion-body bg-light border shadow mb-2 rounded p-3">
                                        <div class="row border-sm-top mt-3 mt-sm-0 add-input">
                                            {{-- Attribute name --}}
                                            <div class="col-md-12 mb-3">
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="options-{{ $key }}-name-icon">
                                                        <i class="fas fa-tag"></i>
                                                    </span>
                                                    <input required wire:model.blur="options.{{ $key }}.name"
                                                        type="text" id="options-{{ $key }}-name"
                                                        class="form-control" placeholder="Attribute name"
                                                        aria-label="Attribute name"
                                                        aria-describedby="options-{{ $key }}-name-icon" />
                                                    {{-- @if ($key > 0)
                                                        <button class="btn btn-sm btn-danger input-group-text"
                                                            wire:click.prevent="remove({{ $key }})">
                                                            <i class="fas fa-square-minus"></i>
                                                        </button>
                                                    @endif --}}
                                                </div>
                                            </div>

                                            {{-- Attribute Options --}}
                                            @foreach ($option['data'] ?? [] as $key2 => $data)
                                                <div class="col-sm-6 mb-3">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text"
                                                            id="{{ md5("$key.$key2-option-data-name-icon") }}">
                                                            <i class="fas fa-clipboard"></i>
                                                        </span>
                                                        <input
                                                            wire:model="options.{{ $key }}.data.{{ $key2 }}.name"
                                                            type="text" id="{{ "$key.$key2-option-data-name" }}"
                                                            class="form-control" placeholder="Option name"
                                                            aria-label="Option name"
                                                            aria-describedby="{{ md5("$key.$key2-option-data-name-icon") }}"
                                                            required />
                                                        @if ($key2 > 0)
                                                            <button class="btn btn-sm btn-danger input-group-text"
                                                                wire:click.prevent="remove({{ $key }}, {{ $key2 }})">
                                                                <i class="fas fa-square-minus"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                    @error('options.{{ $key }}.name')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endforeach

                                            {{-- Add more --}}
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-sm btn-info text-white"
                                                    wire:click.prevent="add({{ $key }}, {{ $x }})">
                                                    <i class="fas fa-plus"></i> more options
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row gy-3 pb-md-0 pb-2">
                                            <div class="col-sm-12">
                                                <ul class="list-group list-group-flush">
                                                    {{-- @foreach ($attribute->options as $option)
                                                            <li class="list-group-item">
                                                                <input class="form-check-input me-1" type="checkbox"
                                                                    value="{{ $key }}"
                                                                    id="option-{{ $key }}">
                                                                <label class="form-check-label"
                                                                    for="firstCheckbox">{{ $option->name }}</label>
                                                            </li>
                                                        @endforeach --}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-info text-white"
                            wire:click.prevent="add({{ $i }})">
                            <i class="fas fa-plus"></i> more attribute
                        </button>
                    </div>

                    <!-- Submit-->
                    <div class="pt-2">
                        <button class="btn btn-lg btn-accent d-block w-100" type="submit">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
