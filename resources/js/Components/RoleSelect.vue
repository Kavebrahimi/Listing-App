<script setup>

import { useForm } from "@inertiajs/vue3";

const props = defineProps({user: Object})

const form = useForm({
  role: props.user.role,
});
const submit = ()=> {
  if (confirm(`تغییر سمت این کاربر به ${form.role}؟`)) {
    form.put(route('admin.role', props.user.id))
  } else {
    form.role = props.user.role
  }
}
</script>

<template>
  
    
  <div class="flex items-center gap-2 ml-auto">
    
    <form @change="submit" class="flex items-center gap-2">

      <label for="roles" class="sr-only">Roles:</label>
      <select v-model="form.role" 
              name="role"
              class=" text-slate-800 bg-slate-200 text-sm py-1 px-5 w-full border-0 outline-0 rounded-lg"
      >
        <option value="admin">ادمین</option>
        <option value="عادی">عادی</option>
        <option value="تعلیق">تعلیق</option>
      </select>
      
    </form>
    
  </div>
    
  
</template>
