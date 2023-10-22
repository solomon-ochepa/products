{{-- Add new Attributes --}}
<section class="row gy-md-3 gy-3 pb-md-0 pb-2 mt-0">
    @foreach ($options ?? [] as $key => $option)
        {{-- Attribute name --}}
        <div class="col-lg-6 col-md-12" wire:key="add-attribute-{{ $key }}">
            <div class="input-group input-group-sm">
                <span class="input-group-text" id="option-{{ $key }}-name-icon">
                    <i class="fas fa-tag"></i>
                </span>

                <input _required wire:model.blur="options.{{ $key }}.name" type="text"
                    id="option-{{ $key }}-name" class="form-control" placeholder="Name"
                    aria-label="Attribute name" aria-describedby="option-{{ $key }}-name-icon" />

                <input _required wire:model.blur="options.{{ $key }}.value" type="text"
                    id="option-{{ $key }}-value" class="form-control" placeholder="Value"
                    aria-label="Attribute value" aria-describedby="option-{{ $key }}-value-icon" />

                @if ($key > 0)
                    <button class="btn btn-sm btn-danger input-group-text"
                        wire:click.prevent="remove({{ $key }})">
                        <i class="fas fa-square-minus"></i>
                    </button>
                @endif
            </div>

            @error('options.{{ $key }}.name')
                <span class="text-danger error">{{ $message }}</span>
            @enderror
            @error('options.{{ $key }}.value')
                <span class="text-danger error">{{ $message }}</span>
            @enderror
        </div>
    @endforeach

    <div class="col-md-12">
        <button type="button" class="btn btn-sm btn-info text-white" wire:click.prevent="add({{ $i }})">
            <i class="fas fa-plus"></i> more attribute
        </button>
    </div>
</section>
