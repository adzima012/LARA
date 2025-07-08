@props(['icon', 'label', 'route'])

@php
    $isActive = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}"
   class="nav-item flex items-center p-3 text-secondary hover:text-accent transition rounded-md relative {{ $isActive ? 'bg-accent/10 text-accent' : '' }}">
    <i class="{{ $icon }} text-lg w-6 text-center"></i>
    <span class="ml-3" x-show="!sidebarCollapsed" x-transition>{{ $label }}</span>
</a>
