<script setup>

import { Link } from "@inertiajs/vue3";

defineProps({
  routeName: String
});

</script>

<template>
  <Link
      class="text-indigo-500 hover:text-indigo-600 font-medium dark:text-indigo-300 dark:hover:text-indigo-400"
      :href="route(routeName)"
  >
    <slot/>
  </Link>
</template>
