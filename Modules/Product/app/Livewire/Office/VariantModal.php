<?php

namespace Modules\Product\app\Livewire\Office;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Attribute\app\Models\Attribute;
use Modules\Attribute\app\Models\AttributeOption;
use Modules\Measurement\app\Models\Unit;
use Modules\Product\app\Http\Requests\StoreVariantRequest;
use Modules\Product\app\Http\Requests\UpdateVariantRequest;
use Modules\Product\app\Models\Variant;
use Plank\Mediable\Facades\MediaUploader;

class VariantModal extends Component
{
    use WithFileUploads;

    /** @var Product main product */
    public $product;

    /** @var Variant product variant to be creaated/updated */
    public $variant;

    public $edit = false;

    /** @var Unit units of measurement */
    public $units;

    // public $options;
    public $options = [];

    public $photo;

    /** @var string existing image or null */
    public $image;

    public $i = 0;

    public $x = 0;

    protected $listeners = [
        'refresh' => '$refresh',
        'variant_edit' => 'edit',
    ];

    protected function rules()
    {
        if ($this->edit) {
            $request = new UpdateVariantRequest($this->variant->toArray());

            return $request->rules();
        } else {
            $request = new StoreVariantRequest();

            return $request->rules();
        }
    }

    public function mount()
    {
        $this->init();
    }

    public function init()
    {
        $this->units = Unit::all();

        if (! $this->variant) {
            $this->variant = new Variant();
        }

        // Add new
        $this->options = [$this->default_option()];
    }

    public function render()
    {
        return view('product::livewire.office.variant-modal');
    }

    public function edit(Variant $variant)
    {
        $this->reset();
        $this->init();

        $this->edit = true;
        $this->variant = $variant;
        $this->image = $variant->hasMedia(['image', 'featured']) ? $variant->media(['image', 'featured'])->first()->getUrl() : null;

        $this->dispatch('variant:edit');
    }

    /**
     * Return default option data
     */
    public function default_option()
    {
        return [
            'name' => '',
            'value' => '',
        ];
    }

    public function add($i)
    {
        array_push($this->options, $this->default_option());
        $this->i = ++$i;
    }

    public function remove($i)
    {
        unset($this->options[$i]);
    }

    public function save()
    {
        $this->validate();

        if ($this->edit) {
            $this->variant->update();

            // Update Variant Attributables
            if ($this->options) {
                $this->update_attributes($this->variant->id, $this->options);
            }

            session()->flash('status', 'Variant updated successfully.');
        } else {
            // Add product_id
            $this->variant = Arr::add($this->variant, 'product_id', $this->product->id);

            // Exists?
            // @todo May possibly be removed as thes creterials doesn't justify a true unique variant or should be improve.
            $exists = Variant::where(Arr::only($this->variant, ['name', 'product_id', 'barcode', 'size', 'unit_code']))->count();
            if ($exists) {
                session()->flash('error', 'Variant already exists.');

                return;
            }

            // Create Variant
            $variant = Variant::create($this->variant);

            // Update Variant Attributables
            if ($this->options) {
                $this->update_attributes($variant->id, $this->options);
            }

            $this->reset('variant');
            session()->flash('status', 'Variant created successfully.');
        }

        if ($this->photo) {
            $this->upload();
        }

        $this->variant->refresh();

        $this->reset(['options', 'photo']);
        $this->dispatch('refresh');
    }

    public function update_attributes($variant, array $attributes)
    {
        $variant = Variant::find($variant);

        foreach ($attributes as $key => $item) {
            if (empty($item['name'])) {
                continue;
            }

            // Attribute name must be singular
            $item['name'] = Str::singular($item['name']);

            // Get: Attribute
            $attribute = Attribute::firstOrCreate(['name' => $item['name']]);

            $option = null;
            if ($item['value']) {
                // Get: Attribute Option/Value
                $option = AttributeOption::firstOrCreate([
                    'attribute_id' => $attribute->id,
                    'name' => $item['value'],
                ]);
            }

            $data['attribute_id'] = $attribute->id;
            $option ? $data['attribute_option_id'] = $option->id : '';

            // Set: Variant Attribute & Option/Value
            if (! $variant->attributables()->where($data)->count()) {
                $variant->attributables()->create($data);
            }
        }
    }

    public function upload()
    {
        if (! $this->photo) {
            return;
        }

        // Upload files
        $upload = MediaUploader::fromSource($this->photo)
            ->toDirectory(rtrim(Str::slug(Variant::class, '_'), '/'))
            ->useFilename($this->variant->name ?? $this->variant->id)
            // ->useHashForFilename()
            ->onDuplicateUpdate()
            ->upload();

        // Media table
        if ($upload) {
            $this->variant->syncMedia($upload, ['image']);

            return true;
        } else {
            return false;
        }
    }
}
