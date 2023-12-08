<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                User
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <!-- <Link
                                class="
                                    px-6
                                    py-2
                                    mb-2
                                    text-green-100
                                    bg-green-500
                                    rounded
                                "
                                :href="route('users.create')"
                            >
                                users Create
                            </Link> -->
                        </div>
                        <!-- <UserTable :users="users.data" /> -->
                        <table>
                            <thead class="font-bold bg-gray-300 border-b-2">
                                <td class="px-4 py-2">ID</td>
                                <td class="px-4 py-2">Name</td>
                                <td class="px-4 py-2">Email</td>
                                <td class="px-4 py-2">Status</td>
                                <td class="px-4 py-2">Action</td>
                            </thead>
                            <tbody>
                                <tr v-for="user in users.data" :key="user.id">
                                    <td class="px-4 py-2">{{ user.id }}</td>
                                    <td class="px-4 py-2">{{ user.first_name }} {{ user.last_name }}</td>
                                    <td class="px-4 py-2">
                                        {{ user.email }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ user.status }}
                                    </td>
                                    <td class="px-4 py-2 font-extrabold">
                                        <Link
                                            class="text-green-700"
                                            :href="route('users.edit', user.id)"
                                        >
                                            Edit
                                        </Link>
                                        <Link
                                            @click="destroy(user.id)"
                                            class="text-red-700"
                                            >Delete</Link
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                         <!-- Pagination links -->
                         <div v-if="users.data.length" class="w-full flex justify-center mt-8 mb-8">
                            <Pagination :links="users.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import Pagination from '@/Components/UI/Pagination.vue'
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import UserTable from '@/Components/UserTable.vue';
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeNavLink,
        Link,
        UserTable,
        Pagination
    },
    data() {
        return {
        users: [] // Fetch and populate users array from your Laravel backend
        };
    },
    props: {
        users: Object,
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route("users.destroy", id));
        },
    },
};
</script>
