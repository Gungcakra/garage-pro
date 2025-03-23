<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\SubMenu;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class MenuManagement extends Component
{
    public $menuId, $menus, $submenus, $name, $route, $order, $icon, $dataSubMenu, $subMenuId,  $subMenuName, $subMenuRoute, $subMenuOrder;
    
    public $isModalOpen = false;

    public function openModal()
    {

        $this->isModalOpen = true;
        $this->dispatch('show-modal');
    }
    public function closeModal()
    {
        $this->reset(['menuId', 'name', 'route', 'order', 'icon']);
        $this->isModalOpen = false;
        $this->dispatch(event: 'hide-modal');
    }

    public function closeSubMenuModal()
    {
        $this->reset(['menuId', 'subMenuName', 'subMenuRoute', 'subMenuRoute']);
        $this->dispatch(event: 'hide-submenu-modal');
    }
    public function render()
    {
        return view('livewire.pages.admin.menu-management', [
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
            'icon' => 'required|string|max:255',
        ]);
        Menu::create([
            'name' => $this->name,
            'route' => $this->route,
            'order' => $this->order,
            'icon' => $this->icon,
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
        $this->icon = $menu->icon;
        $this->dispatch('show-modal');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'order' => 'required|integer',
            'icon' => 'required|string|max:255',
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

    public function createSubMenu($id)
    {
        $this->menuId = $id;  
        $this->dispatch(event: 'show-submenu-modal');
        
    }
    public function storeSubMenu($menuId)
    {
        $this->validate([
            'subMenuName' => 'required|string|max:255',
            'subMenuRoute' => 'required|string|max:255',
            'subMenuOrder' => 'required|integer',
        ]);

        SubMenu::create([
            'menu_id' => $menuId,
            'name' => $this->subMenuName,
            'route' => $this->subMenuRoute,
            'order' => $this->subMenuOrder,
        ]);

        $this->dispatch('success', 'Submenu added successfully!');
        $this->closeSubMenuModal();
    }
    public function deleteSubMenu($id)
    {
        $submenu = SubMenu::findOrFail($id);
        $submenu->delete();
        $this->dispatch('success', 'Submenu deleted successfully!');
    }
    public function editSubMenu($id)
    {
        $submenu = SubMenu::findOrFail($id);
        $this->subMenuId = $id;
        $this->subMenuName = $submenu->name;
        $this->subMenuRoute = $submenu->route;
        $this->subMenuOrder = $submenu->order;
        $this->dispatch('show-submenu-modal');
    }
    public function updateSubMenu($id)
    {
        $this->validate([
            'subMenuName' => 'required|string|max:255',
            'subMenuRoute' => 'required|string|max:255',
            'subMenuOrder' => 'required|integer',
        ]);

        $submenu = SubMenu::findOrFail($id);
        $submenu->update([
            'name' => $this->subMenuName,
            'route' => $this->subMenuRoute,
            'order' => $this->subMenuOrder,
        ]);

        $this->dispatch('success', 'Submenu updated successfully!');
        $this->closeSubMenuModal();
    }
    public function submitForm()
    {
        if ($this->menuId) {
            $this->update();
        } else {
            $this->store();
        }
    }

}
