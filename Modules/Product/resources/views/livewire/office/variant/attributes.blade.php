<section class="">
    <!-- If you look to others for fulfillment, you will never truly be fulfilled. -->
    <div
        class="d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center border-bottom mb-0">
        <h6 class="col m-0">Attributes</h6>
    </div>

    @if ($variant->attributables)
        <div class="row gy-md-3 gy-3 pb-md-0 pb-2 mt-0">
            @foreach ($variant->attributables ?? [] as $key => $attributable)
                <div class="col-lg-4 col-md-6">
                    <div class="input-group input-group-sm">
                        <div class="input-group-text">
                            @can('products.variants.attributes.delete')
                                <a href="javascript://delete" class="text-danger" title="Delete" data-bs-toggle="tooltip"
                                    wire:click="delete('{{ $attributable->id }}')">
                                    <i class="fas fa-minus-square me-1"></i>
                                </a>
                            @endcan

                            {{ $attributable->attribute->name }}
                        </div>

                        <input type="text" class="form-control" value="{{ optional($attributable->option)->name }}" />
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
