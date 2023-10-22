<div class="d-flex align-items-center pt-2 pb-4">
    <!-- Quantity -->
    <input class="form-control me-2" max="" min="1" name="order[unit]" placeholder="Qty" required
        step="1" style="width: 6rem;" type="number" wire:model.live="quantity" />

    <button class="btn btn-primary btn-shadow d-block w-100" type="button" wire:click="add_to_cart()">
        <i class="ci-cart fs-lg me-2"></i>Add to Cart
    </button>
</div>
