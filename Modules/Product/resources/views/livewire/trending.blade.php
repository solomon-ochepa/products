<section class="container py-3">
    <!-- A good traveler has no fixed plans and is not intent upon arriving. -->

    <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom -border-dashed pb-1 mb-3">
        <h2 class="h3 mb-0 pt-3 me-2">Trending products</h2>

        <div class="pt-3">
            <a class="btn btn-outline-accent btn-sm" href="{{ route('product.index', ['sort' => 'trending']) }}">
                More products
                <i class="ci-arrow-right ms-1 me-n1"></i>
            </a>
        </div>
    </div>

    <div class="row pt-0 mx-n2">
        @forelse  ($stocks ?? [] as $item)
            <div class="col-md-2 col-sm-6 px-1 mb-grid-gutter rounded">
                <livewire:product::product :stock="$item" />
            </div>
        @empty
            <p class="text-center py-4">... cooming soon.</p>
        @endforelse
    </div>
</section>
