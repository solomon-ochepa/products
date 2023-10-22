<?php

namespace Modules\Product\app\Livewire\Office\Variant\Attribute;

use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Attribute\app\Models\Attributable;
use Modules\Attribute\app\Models\AttributableOption;
use Modules\Attribute\app\Models\Attribute;
use Modules\Attribute\app\Models\AttributeOption;

class CreateModal extends Component
{
    public $variant;

    public $html_attributes;

    public $options = [];

    public $i = 0;

    public $x = 0;

    public function mount()
    {
        $this->options = [$this->default_option()];
    }

    public function render()
    {
        return view('product::livewire.office.variant.attribute.create-modal');
    }

    public function add($i, $x = null)
    {
        if (is_int($x)) {
            array_push($this->options[$i]['data'], $this->default_data());
        } else {
            array_push($this->options, $this->default_option());
            $this->i = ++$i;
        }
    }

    public function remove($i, $x = null)
    {
        if (is_int($x)) {
            unset($this->options[$i]['data'][$x]);
        } else {
            unset($this->options[$i]);
        }
    }

    /**
     * Return default option data values
     */
    public function default_data()
    {
        return [
            'name' => '',
        ];
    }

    /**
     * Return default option values
     */
    public function default_option()
    {
        return [
            'name' => '',
            'data' => [
                [
                    'name' => '',
                ],
            ],
        ];
    }

    protected $rules = [
        'options.*.name' => ['required', 'string', 'max:32'],
        'options.*.data.*.name' => ['required', 'string', 'max:32'],
    ];

    public function submit()
    {
        $this->validate();

        foreach ($this->options as $item) {
            // Attribute name must be singular
            $item['name'] = Str::singular($item['name']);

            // Get|Store Attribute
            $attribute = Attribute::firstOrCreate([
                'name' => Str::title($item['name']),
            ]);

            // Get|Store Attribute Options
            $options = [];
            foreach ($item['data'] as $key => $attribute_option) {
                $options[$key] = AttributeOption::firstOrCreate([
                    'name' => Str::title(Str::singular($attribute_option['name'])),
                    'attribute_id' => $attribute->id,
                ]);
            }

            // Get|Store Attributables
            $attributable = Attributable::firstOrCreate([
                'attribute_id' => $attribute->id,
                'attributable_type' => Variant::class,
                'attributable_id' => $this->variant->id,
            ]);

            if ($options) {
                foreach ($options as $key => $option) {
                    AttributableOption::firstOrCreate([
                        'attributable_id' => $attributable->id,
                        'attribute_option_id' => $option['id'],
                    ]);
                }
            }
        }

        session()->flash('status', 'html_attributes updated successfully, please refresh the page!');

        $this->variant->refresh();

        $this->reset();
        $this->dispatch('refresh');
    }
}
