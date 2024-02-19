<x-nav sticky class="lg:hidden">
    <x-slot:brand class="flex gap-2 items-center">
        <x-icon name="o-square-3-stack-3d" class="text-primary" />
        <div>App</div>
    </x-slot:brand>
    <x-slot:actions>
        <x-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" />
        <x-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" />
    </x-slot:actions>
</x-nav>
