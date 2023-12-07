
<template>
    <div>
        <div>
            <h1>Home Page</h1>
            <Link href="/example">Go to Example</Link>
            <router-link to="/example">Go to Example</router-link>
        </div>
        <h1>{{ greeting }}</h1>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    props: {
        greeting: String,
    },
    methods: {
        navigateToExample() {
            // Use $inertia.visit to navigate to another page
            this.$inertia.visit(route('example'));
        },
    },
};
</script>
