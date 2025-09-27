<script setup >

defineProps({
  status: String
});

</script>

<template>

  <div class="mb-3 font-medium text-sm dark:text-green-400 text-green-500">
    {{ status }}
  </div>

</template>
