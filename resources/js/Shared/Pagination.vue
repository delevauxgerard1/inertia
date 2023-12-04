<template>
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <template v-for="(link, key) in pagination.links" :key="key">
                    <template v-if="link.label.includes('Previous') || link.label.includes('Next')">
                        <Link :href="link.url"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                            :class="link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'">
                        <span v-if="link.label.includes('Previous')">Anterior</span>
                        <span v-else-if="link.label.includes('Next')">Siguiente</span>
                        </Link>
                    </template>
                </template>
            </nav>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Mostrando del
                    <span class="font-medium">{{ startIndex }}</span>
                    al
                    <span class="font-medium">{{ endIndex }}</span>
                    de
                    <span class="font-medium">{{ total }}</span>
                    resultados
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <template v-for="(link, key) in pagination.links" :key="key">
                        <Link :href="link.url"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                            :class="link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'">
                        <span v-if="link.label.includes('Previous')">Anterior</span>
                        <span v-else-if="link.label.includes('Next')">Siguiente</span>
                        <span v-else>{{ link.label }}</span>
                        </Link>
                    </template>
                </nav>
            </div>


        </div>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';

export default {

    components: {
        Link,
    },
    props: {
        pagination: Object
    },
    computed: {
        startIndex() {
            if (!this.pagination || !this.pagination.total) return 0;
            return (this.pagination.current_page - 1) * this.pagination.per_page + 1;
        },
        endIndex() {
            if (!this.pagination || !this.pagination.total) return 0;
            const end = this.pagination.current_page * this.pagination.per_page;
            return end > this.pagination.total ? this.pagination.total : end;
        },
        total() {
            return this.pagination.total || 0;
        }
    }

}
</script>

<style></style>