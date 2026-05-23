<?php

namespace App\Livewire\Settings;

use App\Models\PaymentGateway;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentGateways extends Component
{
    use WithFileUploads;

    public $search        = '';
    public $filterStatus  = '';

    public $showModal     = false;
    public $editingId     = null;

    public $name, $slug, $description;
    public $merchant_id, $api_key, $api_secret, $webhook_url;
    public $mode         = 'test';
    public $is_active    = false;
    public $sort_order   = 0;
    public $logo;
    public $existingLogo = '';

    public $confirmingDeleteId = null;
    public $extraFields = [];

    public function getGatewaysProperty()
    {
        return PaymentGateway::query()
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('slug', 'like', '%' . $this->search . '%')
            )
            ->when($this->filterStatus !== '', fn($q) =>
                $q->where('is_active', (bool) $this->filterStatus)
            )
            ->orderBy('sort_order')
            ->get();
    }

    public function toggleActive($id)
    {
        $gw = PaymentGateway::findOrFail($id);
        $gw->update(['is_active' => !$gw->is_active]);
        session()->flash('success', "'{$gw->name}' status updated.");
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->dispatch('gatewayModalOpened', content: ''); // ← Added
    }

    public function openEdit($id)
    {
        $gw = PaymentGateway::findOrFail($id);
        $this->editingId      = $gw->id;
        $this->name           = $gw->name;
        $this->slug           = $gw->slug;
        $this->description    = $gw->description;
        $this->merchant_id    = $gw->merchant_id;
        $this->api_key        = $gw->api_key;
        $this->api_secret     = $gw->api_secret;
        $this->webhook_url    = $gw->webhook_url;
        $this->mode           = $gw->mode;
        $this->is_active      = $gw->is_active;
        $this->sort_order     = $gw->sort_order;
        $this->existingLogo   = $gw->logo ?? '';
        $this->logo           = null;
        $this->extraFields    = $gw->extra_fields
                                    ? collect($gw->extra_fields)->map(fn($v, $k) => ['key' => $k, 'value' => $v])->values()->toArray()
                                    : [];
        $this->showModal = true;
        $this->dispatch('gatewayModalOpened', content: $gw->description ?? ''); // ← Added
    }

    public function save()
    {
        $this->validate([
            'name'        => 'required|string|max:100',
            'slug'        => 'required|string|max:100|alpha_dash|unique:payment_gateways,slug,' . ($this->editingId ?? 'NULL'),
            'description' => 'nullable|string',
            'merchant_id' => 'nullable|string|max:200',
            'api_key'     => 'nullable|string|max:500',
            'api_secret'  => 'nullable|string|max:500',
            'webhook_url' => 'nullable|url|max:500',
            'mode'        => 'required|in:test,live',
            'sort_order'  => 'integer|min:0',
            'logo'        => 'nullable|image|max:2048',
        ]);

        $extra = [];
        foreach ($this->extraFields as $row) {
            if (!empty($row['key'])) {
                $extra[$row['key']] = $row['value'];
            }
        }

        $data = [
            'name'         => $this->name,
            'slug'         => Str::slug($this->slug, '_'),
            'description'  => $this->description,
            'merchant_id'  => $this->merchant_id,
            'api_key'      => $this->api_key,
            'api_secret'   => $this->api_secret,
            'webhook_url'  => $this->webhook_url,
            'mode'         => $this->mode,
            'is_active'    => $this->is_active,
            'sort_order'   => $this->sort_order,
            'extra_fields' => !empty($extra) ? $extra : null,
        ];

        if ($this->logo) {
            if ($this->existingLogo) {
                Storage::disk('public')->delete($this->existingLogo);
            }
            $data['logo']       = $this->logo->store('payment_gateways', 'public');
            $this->existingLogo = $data['logo'];
            $this->logo         = null;
        }

        if ($this->editingId) {
            PaymentGateway::findOrFail($this->editingId)->update($data);
            $msg = 'Gateway updated successfully.';
        } else {
            PaymentGateway::create($data);
            $msg = 'Gateway added successfully.';
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $msg);
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function delete()
    {
        $gw = PaymentGateway::findOrFail($this->confirmingDeleteId);
        if ($gw->logo) Storage::disk('public')->delete($gw->logo);
        $gw->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Gateway deleted.');
    }

    public function addExtraField()
    {
        $this->extraFields[] = ['key' => '', 'value' => ''];
    }

    public function removeExtraField($index)
    {
        array_splice($this->extraFields, $index, 1);
    }

    public function updatedName($value)
    {
        if (!$this->editingId) {
            $this->slug = Str::slug($value, '_');
        }
    }

    private function resetForm()
    {
        $this->editingId     = null;
        $this->name          = '';
        $this->slug          = '';
        $this->description   = '';
        $this->merchant_id   = '';
        $this->api_key       = '';
        $this->api_secret    = '';
        $this->webhook_url   = '';
        $this->mode          = 'test';
        $this->is_active     = false;
        $this->sort_order    = 0;
        $this->logo          = null;
        $this->existingLogo  = '';
        $this->extraFields   = [];
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.settings.payment-gateways')
            ->layout('layouts.admin');
    }
}