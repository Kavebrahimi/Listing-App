<script setup>

defineProps({
  paginator: Object
});

</script>

<template>
  <div class="flex flex-col items-center gap-y-5">
    <div class="flex items-center rounded-md overflow-hidden shadow-lg mx-auto">
      <div v-for="(link, i) in paginator.links" :key="i">

        <component
            :is="link.url ? 'Link' : 'span' "
            :href="link.url"
            v-html="link.label"
            class="border-x border-slate-50 w-12 h-12 grid
                  place-items-center bg-white dark:bg-slate-900 dark:border-slate-800 transition duration-200"
            :class=" {
              ' dark:hover:bg-slate-500   hover:bg-slate-300' :
             link.url,
             'text-slate-400 cursor-not-allowed' : !link.url,
             'font-bold text-indigo-500 dark:text-indigo-400 pointer-events-none !bg-slate-300 dark:!bg-slate-200' : link.active
            } "
        />

      </div>
    </div>

    <p class="text-slate-600 dark:text-slate-200 text-sm">
      نمایش {{ paginator.from }} تا {{ paginator.to }} از {{ paginator.total }} آیتم
    </p>

  </div>
</template>
