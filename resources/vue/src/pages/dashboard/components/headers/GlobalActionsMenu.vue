<template>
    <Menu as="div" class="relative inline-block text-left">
        <div>
            <MenuButton class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                <span class="hidden sm:inline">Acciones Globales</span>
                <span class="sm:hidden">Acciones</span>
                <ChevronDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
            </MenuButton>
        </div>
        <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <MenuItems class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <a
                            href="#"
                            @click.prevent="viewReports"
                            :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                            Ver Reportes
                        </a>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script>
    import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
    import { ChevronDownIcon } from '@heroicons/vue/20/solid';

    export default {
        name: 'GlobalActionsMenu',
        components: {
            Menu,
            MenuButton,
            MenuItems,
            MenuItem,
            ChevronDownIcon
        },
        methods: {
            viewReports() {
                // Logic to view reports
            }
        }
    };
</script>