<script setup>

</script>

<template>
  <button
      class="px-6 py-2 rounded-lg  bg-slate-950 text-white disabled:bg-slate-300 disabled:!cursor-wait
            disabled:text-slate-500
            dark:bg-slate-200 dark:text-black hover:bg-indigo-500 hover:text-white transition-colors"
  >
    <slot/>
  </button>
</template>
