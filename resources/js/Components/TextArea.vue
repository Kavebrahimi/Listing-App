<script setup>

const  model = defineModel();

defineProps({
  inputLabel: String,
  icon: String,
  placeholder: {
    type: String,
    default: ""
  },
  error: String,
  name: String,
  id: {
    type: String,
    default: ""
  }

});
</script>

<template>

  <div class="space-y-2">
    <label
        :for="id"
        class="block text-sm font-medium text-slate-700 dark:text-slate-300"
    >
      {{inputLabel}}
    </label>

    <div class="relative mt-1 rounded-md">
      <div class="pointer-events-none absolute top-3 right-0 flex items-center pr-3">
        <span
            class="grid place-content-center text-sm "
            :class="error ? ['text-red-500', 'dark:text-red-300'] : ['text-slate-500', 'dark:text-slate-300' ]"
        >
          <i :class="`pi pi-${icon}`"></i>
        </span>
      </div>
      <textarea
          rows="6"
          v-model="model"
          :name="name"
          :id="id"
          :placeholder="placeholder"
          class="block w-full rounded-md py-3 pl-3 pr-10 text-sm ring-1
          dark:text-white dark:bg-slate-700 border-slate-300 outline-0
        ring-indigo-300 focus:ring-indigo-400 transition
        focus:border-indigo-400 placeholder:text-slate-400"
      ></textarea>
    </div>
    <p v-if="error" class="text-sm mt-2 dark:text-red-300 text-red-500">{{ error }}</p>
  </div>


</template>
