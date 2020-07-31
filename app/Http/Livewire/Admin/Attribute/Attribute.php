<?php

namespace App\Http\Livewire\Admin\Attribute;

use App\Attribute as attr;
use App\Attribute_Family;
use Livewire\Component;

class Attribute extends Component
{
    public $attr;
    public $attribute = [];

    public function mount($attr)
    {
        $this->attr = $attr;
    }
    public function render()
    {
        $attr = Attribute_Family::find($this->attr->id);
        //dd($attr->attributes);
        return view('livewire.admin.attribute.attribute', ['attributes'=>$attr->attributes]);
    }

    public function remove($id)
    {
        attr::find($id)->delete();
    }
    public function removeLang($id, $lang)
    {
        attr::find($id)->setTranslation('name', $lang, null);
    }
    public function add_attribute($name)
    {
        if ($name && is_string($name)) {

            attr::create([
                'name'      => $name,
                'family_id' => $this->attr->id,
            ]);
        }
    }
    public function add_lang($name, $id)
    {
        if ($name && is_string($name)) {

            attr::find($id)->forgetTranslation('name', $newName);

        }
    }
    public function update_attribute_lang($newName,$lang, $id)
    {
        $attr = attr::find($id);
        if($attr) {
            $attr->setTranslation('name', $lang, $newName)
            ->save();
        }

    }
}
