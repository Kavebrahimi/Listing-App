<script setup>

const model = defineModel();

defineProps({
  name: String
});

let checked = false;
const clicked = ()=>{
  checked = checked === false;
}

</script>

<template>

  <div class="flex items-center gap-x-1">

    <input
        type="checkbox"
        v-model="model"
        :id="name"
        class="peer sr-only"
        @click="clicked"
    >
    <label
        :for="name"
        class="text-sm font-medium text-slate-500 dark:text-slate-300 cursor-pointer flex items-center gap-x-2 select-none"
    >
      <span
          class="inline-block w-4 h-4 bg-white rounded-md outline-2 outline-indigo-300
                dark:bg-slate-700 relative"
      >
        <span class="absolute w-3 h-3 bg-indigo-600 dark:bg-slate-300 rounded-full
                    left-1/2 top-1/2 -translate-1/2 transition duration-200"
              :class="checked === true ? 'opacity-100' : 'opacity-0' "
        >
        </span>
      </span>
      <span><slot/></span>
    </label>

  </div>

</template>
