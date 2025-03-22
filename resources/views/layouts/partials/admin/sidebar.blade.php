<?php
use App\Models\Menu;

$menus = Menu::with('submenus')->get();
?>

<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="{{ route('dashboard') }}">
            <img alt="Logo" src="{{ asset('assets/media/logos/default-dark.svg') }}" class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('assets/media/logos/default-small.svg') }}" class="h-20px app-sidebar-logo-minimize" />
        </a>
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>

    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    
                    @foreach ($menus as $menu)
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs($menu->submenus->pluck('route')->toArray()) ? 'show' : '' }}">
                            <span class="menu-link {{ request()->routeIs($menu->submenus->pluck('route')->toArray()) ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <i class="{{ $menu->icon }} fs-2"></i>
                                </span>
                                <span class="menu-title">{{ $menu->name }}</span>
                                @if ($menu->submenus->count() > 0)
                                    <span class="menu-arrow"></span>
                                @endif
                            </span>

                            @if ($menu->submenus->count() > 0)
                                <div class="menu-sub menu-sub-accordion">
                                    @foreach ($menu->submenus as $submenu)
                                        <div class="menu-item">
                                            <a class="menu-link {{ request()->routeIs($submenu->route) ? 'active' : '' }}" href="{{ route($submenu->route) }}" wire:navigate>
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">{{ $submenu->name }}</span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
