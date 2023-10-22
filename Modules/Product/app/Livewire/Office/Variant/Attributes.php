<?php

namespace Modules\Product\app\Livewire\Office\Variant;

use Livewire\Component;
use Modules\Attribute\app\Models\Attributable;

class Attributes extends Component
{
    public $variant;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function render()
    {
        return view('product::livewire.office.variant.attributes');
    }

    public function updated($name, $value)
    {
        dd($name);
    }

    public function delete(Attributable $attributable)
    {
        $attributable->delete();
        $this->variant->refresh();

        // $this->dispatch('refresh');
        session()->flash('status', "Attribute {{$attributable->attribute->name}} has been deleted successfully.");
    }
}
