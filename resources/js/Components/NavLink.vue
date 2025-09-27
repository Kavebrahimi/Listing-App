<script setup>
defineProps({
  routeName: String,
  componentName: String,
});
</script>

<template>
  <Link
      :href="route(routeName)"
      class="py-2 px-4 hover:bg-slate-700 rounded-lg transition-colors"
      :class="{'bg-slate-700' : $page.component === componentName}"
  >
    <slot/>
  </Link>
</template>

<style scoped>

</style>
