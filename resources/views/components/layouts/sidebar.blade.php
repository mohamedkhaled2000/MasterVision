<x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit shadow-amber-800">

    {{-- BRAND --}}
    <div class="p-6 pt-3 flex gap-3 items-center h-20">
        <x-icon name="o-square-3-stack-3d" class="text-primary" />
        <div class="hidden-when-collapsed">App</div>
    </div>

    {{-- MENU --}}
    <x-menu activate-by-route>

        {{-- User --}}
        @if ($user = auth()->user())
            <x-list-item :item="$user" sub-value="username" no-separator no-hover
                class="!-mx-2 mt-2 mb-5 border-y border-y-sky-900">
                <x-slot:actions>
                    <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" />
                </x-slot:actions>
            </x-list-item>
        @endif

        <x-menu-item title="Posts" icon="o-pencil" :link="route('posts')" />
        <x-menu-sub title="Settings" icon="o-cog-6-tooth">
            <x-menu-item title="Wifi" icon="o-wifi" link="####" />
            <x-menu-item title="Archives" icon="o-archive-box" link="####" />
        </x-menu-sub>
    </x-menu>
</x-slot:sidebar>
