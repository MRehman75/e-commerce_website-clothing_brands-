<?php

namespace App\Livewire\WebsiteContent;

use App\Models\Menu;
use App\Models\MenuItem;
use Livewire\Component;

class MenuManager extends Component
{
    // Active menu tab
    public $activeMenuId = null;

    // Menu form
    public $menuName     = '';
    public $menuLocation = 'header';
    public $editingMenuId   = null;
    public $showMenuModal   = false;
    public $confirmingDeleteMenuId = null;

    // Item form
    public $itemMenuId      = null;
    public $itemParentId    = '';
    public $itemLabel       = '';
    public $itemUrl         = '';
    public $itemIcon        = '';
    public $itemNewTab      = false;
    public $itemSortOrder   = 0;
    public $itemActive      = true;
    public $editingItemId   = null;
    public $showItemModal   = false;
    public $confirmingDeleteItemId = null;

    public function mount()
    {
        $first = Menu::first();
        if ($first) $this->activeMenuId = $first->id;
    }

    // ════════════════════════════════
    // MENUS
    // ════════════════════════════════
    public function openCreateMenu()
    {
        $this->editingMenuId = null;
        $this->menuName      = '';
        $this->menuLocation  = 'header';
        $this->showMenuModal = true;
    }

    public function openEditMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $this->editingMenuId = $menu->id;
        $this->menuName      = $menu->name;
        $this->menuLocation  = $menu->location;
        $this->showMenuModal = true;
    }

    public function saveMenu()
    {
        $this->validate([
            'menuName'     => 'required|string|max:100',
            'menuLocation' => 'required|string|max:50',
        ]);

        $menu = Menu::updateOrCreate(
            ['id' => $this->editingMenuId],
            ['name' => $this->menuName, 'location' => $this->menuLocation]
        );

        if (!$this->editingMenuId) {
            $this->activeMenuId = $menu->id;
        }

        $this->showMenuModal = false;
        session()->flash('success', $this->editingMenuId ? 'Menu updated.' : 'Menu created.');
    }

    public function confirmDeleteMenu($id)  { $this->confirmingDeleteMenuId = $id; }

    public function deleteMenu()
    {
        Menu::findOrFail($this->confirmingDeleteMenuId)->delete();
        $this->confirmingDeleteMenuId = null;
        $first = Menu::first();
        $this->activeMenuId = $first?->id;
        session()->flash('success', 'Menu deleted.');
    }

    // ════════════════════════════════
    // ITEMS
    // ════════════════════════════════
    public function openCreateItem($menuId, $parentId = null)
    {
        $this->resetItemForm();
        $this->itemMenuId   = $menuId;
        $this->itemParentId = $parentId ?? '';
        $this->showItemModal = true;
    }

    public function openEditItem($id)
    {
        $item = MenuItem::findOrFail($id);
        $this->editingItemId  = $item->id;
        $this->itemMenuId     = $item->menu_id;
        $this->itemParentId   = $item->parent_id ?? '';
        $this->itemLabel      = $item->label;
        $this->itemUrl        = $item->url ?? '';
        $this->itemIcon       = $item->icon ?? '';
        $this->itemNewTab     = $item->open_in_new_tab;
        $this->itemSortOrder  = $item->sort_order;
        $this->itemActive     = $item->is_active;
        $this->showItemModal  = true;
    }

    public function saveItem()
    {
        $this->validate([
            'itemLabel'      => 'required|string|max:100',
            'itemUrl'        => 'nullable|string|max:500',
            'itemIcon'       => 'nullable|string|max:100',
            'itemSortOrder'  => 'integer|min:0',
        ]);

        MenuItem::updateOrCreate(
            ['id' => $this->editingItemId],
            [
                'menu_id'         => $this->itemMenuId,
                'parent_id'       => $this->itemParentId ?: null,
                'label'           => $this->itemLabel,
                'url'             => $this->itemUrl ?: null,
                'icon'            => $this->itemIcon ?: null,
                'open_in_new_tab' => $this->itemNewTab,
                'sort_order'      => $this->itemSortOrder,
                'is_active'       => $this->itemActive,
            ]
        );

        $this->showItemModal = false;
        $this->resetItemForm();
        session()->flash('success', $this->editingItemId ? 'Item updated.' : 'Item added.');
    }

    public function toggleItemActive($id)
    {
        $item = MenuItem::findOrFail($id);
        $item->update(['is_active' => !$item->is_active]);
    }

    public function moveUp($id)
    {
        $item = MenuItem::findOrFail($id);
        $prev = MenuItem::where('menu_id',   $item->menu_id)
                        ->where('parent_id', $item->parent_id)
                        ->where('sort_order', '<', $item->sort_order)
                        ->orderBy('sort_order', 'desc')->first();
        if ($prev) {
            [$item->sort_order, $prev->sort_order] = [$prev->sort_order, $item->sort_order];
            $item->save(); $prev->save();
        }
    }

    public function moveDown($id)
    {
        $item = MenuItem::findOrFail($id);
        $next = MenuItem::where('menu_id',   $item->menu_id)
                        ->where('parent_id', $item->parent_id)
                        ->where('sort_order', '>', $item->sort_order)
                        ->orderBy('sort_order')->first();
        if ($next) {
            [$item->sort_order, $next->sort_order] = [$next->sort_order, $item->sort_order];
            $item->save(); $next->save();
        }
    }

    public function confirmDeleteItem($id)  { $this->confirmingDeleteItemId = $id; }

    public function deleteItem()
    {
        MenuItem::findOrFail($this->confirmingDeleteItemId)->delete();
        $this->confirmingDeleteItemId = null;
        session()->flash('success', 'Item deleted.');
    }

    private function resetItemForm()
    {
        $this->editingItemId = null;
        $this->itemMenuId = $this->itemParentId = null;
        $this->itemLabel = $this->itemUrl = $this->itemIcon = '';
        $this->itemNewTab    = false;
        $this->itemSortOrder = 0;
        $this->itemActive    = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        $menus       = Menu::withCount('items')->get();
        $activeMenu  = $this->activeMenuId
            ? Menu::with(['rootItems.children'])->find($this->activeMenuId)
            : null;

        // Parent items for dropdown in modal
        $parentItems = $this->itemMenuId
            ? MenuItem::where('menu_id', $this->itemMenuId)
                      ->whereNull('parent_id')
                      ->orderBy('sort_order')
                      ->get()
            : collect();

        return view('livewire.website-content.menu-manager', compact(
            'menus', 'activeMenu', 'parentItems'
        ))->layout('layouts.admin');
    }
}