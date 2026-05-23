<?php

namespace App\Livewire\WebsiteContent;

use App\Models\FooterSetting;
use App\Models\FooterColumn;
use App\Models\FooterLink;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class FooterSettings extends Component
{
    use WithFileUploads;

    public $activeTab = 'general';

    // ── General ──
    public $logo, $existingLogo = '';
    public $company_name, $about_text, $copyright_text;

    // ── Contact ──
    public $email, $phone, $address;

    // ── Social ──
    public $facebook, $instagram, $twitter, $youtube, $tiktok, $whatsapp;

    // ── Newsletter ──
    public $show_newsletter   = true;
    public $newsletter_title, $newsletter_subtitle;

    // ── Apps ──
    public $playstore_link, $appstore_link;

    // ── Payment Methods ──
    public $payment_methods = [];
    public $availablePayments = [
        'visa'        => 'Visa',
        'mastercard'  => 'Mastercard',
        'easypaisa'   => 'Easypaisa',
        'jazzcash'    => 'JazzCash',
        'cod'         => 'Cash on Delivery',
        'bank'        => 'Bank Transfer',
    ];

    // ── Bottom Bar ──
    public $show_bottom_bar = true;

    // ── Columns ──
    public $columns = [];
    public $columnTitle     = '';
    public $columnSortOrder = 0;
    public $editingColumnId = null;
    public $showColumnModal = false;

    // ── Links ──
    public $links          = [];
    public $activeColumnId = null;
    public $linkLabel, $linkUrl;
    public $link_open_in_new_tab = false;
    public $linkSortOrder        = 0;
    public $editingLinkId        = null;
    public $showLinkModal        = false;

    // ── Delete ──
    public $confirmingDeleteColumnId = null;
    public $confirmingDeleteLinkId   = null;

    public function mount()
    {
        $s = FooterSetting::instance();

        $this->existingLogo        = $s->logo ?? '';
        $this->company_name        = $s->company_name;
        $this->about_text          = $s->about_text;
        $this->copyright_text      = $s->copyright_text;
        $this->email               = $s->email;
        $this->phone               = $s->phone;
        $this->address             = $s->address;
        $this->facebook            = $s->facebook;
        $this->instagram           = $s->instagram;
        $this->twitter             = $s->twitter;
        $this->youtube             = $s->youtube;
        $this->tiktok              = $s->tiktok;
        $this->whatsapp            = $s->whatsapp;
        $this->show_newsletter     = $s->show_newsletter;
        $this->newsletter_title    = $s->newsletter_title;
        $this->newsletter_subtitle = $s->newsletter_subtitle;
        $this->playstore_link      = $s->playstore_link;
        $this->appstore_link       = $s->appstore_link;
        $this->payment_methods     = $s->payment_methods ?? [];
        $this->show_bottom_bar     = $s->show_bottom_bar;

        $this->loadColumns();
    }

    private function loadColumns()
    {
        $this->columns = FooterColumn::with('links')->orderBy('sort_order')->get()->toArray();
    }

    // ════════════════════════════════
    // GENERAL / SETTINGS SAVE
    // ════════════════════════════════
    public function saveSettings()
    {
        $this->validate([
            'company_name'        => 'nullable|string|max:200',
            'about_text'          => 'nullable|string',
            'copyright_text'      => 'nullable|string|max:300',
            'email'               => 'nullable|email|max:200',
            'phone'               => 'nullable|string|max:50',
            'address'             => 'nullable|string|max:500',
            'facebook'            => 'nullable|url|max:300',
            'instagram'           => 'nullable|url|max:300',
            'twitter'             => 'nullable|url|max:300',
            'youtube'             => 'nullable|url|max:300',
            'tiktok'              => 'nullable|url|max:300',
            'whatsapp'            => 'nullable|string|max:20',
            'newsletter_title'    => 'nullable|string|max:200',
            'newsletter_subtitle' => 'nullable|string|max:300',
            'playstore_link'      => 'nullable|url|max:300',
            'appstore_link'       => 'nullable|url|max:300',
            'logo'                => 'nullable|image|max:2048',
        ]);

        $s    = FooterSetting::instance();
        $data = [
            'company_name'        => $this->company_name,
            'about_text'          => $this->about_text,
            'copyright_text'      => $this->copyright_text,
            'email'               => $this->email,
            'phone'               => $this->phone,
            'address'             => $this->address,
            'facebook'            => $this->facebook,
            'instagram'           => $this->instagram,
            'twitter'             => $this->twitter,
            'youtube'             => $this->youtube,
            'tiktok'              => $this->tiktok,
            'whatsapp'            => $this->whatsapp,
            'show_newsletter'     => $this->show_newsletter,
            'newsletter_title'    => $this->newsletter_title,
            'newsletter_subtitle' => $this->newsletter_subtitle,
            'playstore_link'      => $this->playstore_link,
            'appstore_link'       => $this->appstore_link,
            'payment_methods'     => $this->payment_methods,
            'show_bottom_bar'     => $this->show_bottom_bar,
        ];

        if ($this->logo) {
            if ($this->existingLogo) Storage::disk('public')->delete($this->existingLogo);
            $data['logo']       = $this->logo->store('footer', 'public');
            $this->existingLogo = $data['logo'];
            $this->logo         = null;
        }

        $s->update($data);
 
        session()->flash('success', 'Footer settings saved.');
    }

    // ════════════════════════════════
    // COLUMNS
    // ════════════════════════════════
    public function openCreateColumn()
    {
        $this->editingColumnId = null;
        $this->columnTitle     = '';
        $this->columnSortOrder = 0;
        $this->showColumnModal = true;
    }

    public function openEditColumn($id)
    {
        $col = FooterColumn::findOrFail($id);
        $this->editingColumnId = $col->id;
        $this->columnTitle     = $col->title;
        $this->columnSortOrder = $col->sort_order;
        $this->showColumnModal = true;
    }

    public function saveColumn()
    {
        $this->validate([
            'columnTitle'     => 'required|string|max:100',
            'columnSortOrder' => 'integer|min:0',
        ]);

        FooterColumn::updateOrCreate(
            ['id' => $this->editingColumnId],
            ['title' => $this->columnTitle, 'sort_order' => $this->columnSortOrder]
        );

        $this->showColumnModal = false;
        $this->loadColumns();
        session()->flash('success', $this->editingColumnId ? 'Column updated.' : 'Column added.');
    }

    public function toggleColumnActive($id)
    {
        $col = FooterColumn::findOrFail($id);
        $col->update(['is_active' => !$col->is_active]);
        $this->loadColumns();
    }

    public function confirmDeleteColumn($id) { $this->confirmingDeleteColumnId = $id; }

    public function deleteColumn()
    {
        FooterColumn::findOrFail($this->confirmingDeleteColumnId)->delete();
        $this->confirmingDeleteColumnId = null;
        $this->loadColumns();
        session()->flash('success', 'Column deleted.');
    }

    // ════════════════════════════════
    // LINKS
    // ════════════════════════════════
    public function openCreateLink($columnId)
    {
        $this->activeColumnId        = $columnId;
        $this->editingLinkId         = null;
        $this->linkLabel             = '';
        $this->linkUrl               = '';
        $this->link_open_in_new_tab  = false;
        $this->linkSortOrder         = 0;
        $this->showLinkModal         = true;
    }

    public function openEditLink($id)
    {
        $link = FooterLink::findOrFail($id);
        $this->editingLinkId        = $link->id;
        $this->activeColumnId       = $link->footer_column_id;
        $this->linkLabel            = $link->label;
        $this->linkUrl              = $link->url;
        $this->link_open_in_new_tab = $link->open_in_new_tab;
        $this->linkSortOrder        = $link->sort_order;
        $this->showLinkModal        = true;
    }

    public function saveLink()
    {
        $this->validate([
            'linkLabel'   => 'required|string|max:100',
            'linkUrl'     => 'required|string|max:500',
            'linkSortOrder' => 'integer|min:0',
        ]);

        FooterLink::updateOrCreate(
            ['id' => $this->editingLinkId],
            [
                'footer_column_id' => $this->activeColumnId,
                'label'            => $this->linkLabel,
                'url'              => $this->linkUrl,
                'open_in_new_tab'  => $this->link_open_in_new_tab,
                'sort_order'       => $this->linkSortOrder,
            ]
        );

        $this->showLinkModal = false;
        $this->loadColumns();
        session()->flash('success', $this->editingLinkId ? 'Link updated.' : 'Link added.');
    }

    public function toggleLinkActive($id)
    {
        $link = FooterLink::findOrFail($id);
        $link->update(['is_active' => !$link->is_active]);
        $this->loadColumns();
    }

    public function confirmDeleteLink($id) { $this->confirmingDeleteLinkId = $id; }

    public function deleteLink()
    {
        FooterLink::findOrFail($this->confirmingDeleteLinkId)->delete();
        $this->confirmingDeleteLinkId = null;
        $this->loadColumns();
        session()->flash('success', 'Link deleted.');
    }

    public function render()
    {
        return view('livewire.website-content.footer-settings')
            ->layout('layouts.admin');
    }
}