<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\SubMenu;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class MenuManagement extends Component
{
    public $menus, $submenus, $menuId, $name, $route, $order;
    public $isModalOpen = false;

    public function openModal()
    {

        $this->isModalOpen = true;

    }
    public function closeModal()
    {
        $this->reset(['menuId', 'name', 'route', 'order']);
        $this->isModalOpen = false;
    }
    public function render()
    {
        return view('livewire.pages.admin.menu-management',[
            'data' => Menu::with('submenus')->get(),
        ]);
    }

    public function create()
    {
        $this->openModal();
    }
    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);
        Menu::create([
            'name' => $this->name,
            'route' => $this->route,
            'order' => $this->order,
        ]);

        $this->dispatch('success', 'Menu added successfully!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $this->menuId = $id;
        $this->name = $menu->name;
        $this->route = $menu->route;
        $this->order = $menu->order;
        $this->dispatch('show-menu-modal');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);

        $menu = Menu::findOrFail($this->menuId);
        $menu->update([
            'name' => $this->name,
            'route' => $this->route,
            'order' => $this->order,
        ]);

        $this->dispatch('success', 'Menu updated successfully!');
        $this->closeModal();
    }
    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        $this->dispatch('success', 'Menu deleted successfully!');
    }
    public function deleteSubMenu($id)
    {
        $submenu = SubMenu::findOrFail($id);
        $submenu->delete();
        $this->dispatch('success', 'Submenu deleted successfully!');
    }
    public function storeSubMenu($menuId)
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);

        SubMenu::create([
            'menu_id' => $menuId,
            'name' => $this->name,
            'route' => $this->route,
            'order' => $this->order,
        ]);

        $this->dispatch('success', 'Submenu added successfully!');
        $this->closeModal();
    }
    public function editSubMenu($id)
    {
        $submenu = SubMenu::findOrFail($id);
        $this->menuId = $submenu->menu_id;
        $this->name = $submenu->name;
        $this->route = $submenu->route;
        $this->order = $submenu->order;
        $this->dispatch('show-submenu-modal');
    }
    public function updateSubMenu()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);

        $submenu = SubMenu::findOrFail($this->menuId);
        $submenu->update([
            'name' => $this->name,
            'route' => $this->route,
            'order' => $this->order,
        ]);

        $this->dispatch('success', 'Submenu updated successfully!');
        $this->closeModal();
    }
    public function submitForm()
    {
        if ($this->menuId) {
            $this->update();
        } else {
            $this->store();
        }
    }
    public function submitSubMenuForm()
    {
        if ($this->menuId) {
            $this->updateSubMenu();
        } else {
            $this->storeSubMenu($this->menuId);
        }
    }
}
