<script setup>

import PaginationLinks from "@/Components/PaginationLinks.vue";
import RoleSelect from '@/Components/RoleSelect.vue';
import SessionMessage from "@/Components/SessionMessage.vue";
import InputField from "@/Components/InputField.vue";
import { router, useForm } from "@inertiajs/vue3";
import CheckBox from "@/Components/CheckBox.vue";

defineProps({users:Object, status: String});

const params = route().params;
const form = useForm({search: params.search});
const search = ()=> {
  router.get(route('admin.index'), {
    search: form.search,
    user_role: params.user_role
  })
};

const toggleRole = (e)=>{
  if (e.target.checked) {
    router.get(route('admin.index', {
      search: params.search,
      user_role: 'تعلیق' 
    }));
  } else {
    router.get(route('admin.index', {
      search: params.search,
      user_role: null
    }));
  }
}

</script>

<template>
  
  <Head title="| داشبورد ادمین"/>

  <section class="w-4/5 m-auto">
    <SessionMessage :status="status"/>
    <!--    Heading     -->
    <div class="flex items-center justify-between mb-4">
      <!--    Search From     -->
      <div class="flex items-end gap-2">
        <form @submit.prevent="search">
          <InputField
              v-model="form.search"
              inputLabel=""
              icon="search"
              placeholder="جستجو..."
          />
        </form>
        <Link
            class="flex items-center gap-x-0.5 py-1.5 px-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-700"
            v-if="params.search"
            :href="route('admin.index', { ...params, search:null, page:null })"
        >
          <span>{{ params.search }}</span>
          <i class="pi pi-times text-xs"></i>
        </Link>
      </div>
      <!--    Toggle Role Btn     -->
      <div class="flex items-center  gap-1 text-xs rounded-md
                  hover:bg-slate-300 dark:hover:bg-slate-800 px-2 py-1"
      >
        <input
            @input="toggleRole"
            :checked="params.user_role === 'تعلیق'"
            class="rounded-md border-1 outline-0 text-indigo-500
                  ring-indigo-500 border-slate-700 cursor-pointer"
            type="checkbox"
            id="toggleRole"
        >
        <label for="toggleRole" class="block text-sm font-medium 
                    text-slate-700 dark:text-slate-300 cursor-pointer">
          نمایش کاربرا تعلیق شده
        </label>
      </div>
    </div>

    <!--    Table     -->
    <table class="bg-white dark:bg-slate-800 w-full rounded-lg 
                overflow-hidden ring-1 ring-slate-300">
      <thead>
      <tr class="bg-slate-600 text-slate-300 uppercase text-sm text-right">
        <th class="w-3/6 p-3">نام</th>
        <th class="w-2/6 p-3">سمت</th>
        <th class="w-2/6 p-3">درخواست ها</th>
        <th class="w-1/6 p-3 text-left">نمایش</th>
      </tr>
      </thead>
      <tbody class="divide-y divide-slate-300 divide-dashed">
        <tr v-for="user in users.data" :key="user.id">
          <td class="w-3/6 py-5 px-3">
            <p class="font-bold mb-1">{{ user.full_name }}</p>
            <p class="font text-sm">{{ user.email }}</p>
          </td>
          <td class="w-2/6 py-5 px-3">
            <RoleSelect :user="user"/>
          </td>
          <td class="w-2/6 py-5 px-3">
            <div class="flex items-center gap-6">
              <div class="flex items-center gap-1">
                <p>{{ user.listings.filter(e=> e.approved).length }}</p>
                <i class="pi pi-check-circle text-green-500"></i>
              </div>
              <div class="flex items-center gap-1">
                <p>{{ user.listings.filter(e=> !e.approved).length }}</p>
                <i class="pi pi-times-circle text-red-500"></i>
              </div>
            </div>
          </td>
          <td class="w-1/6 py-5 px-3 text-left">
            <Link :href="route('user.show', user)" class="pi pi-external-link px-3 text-indigo-400"></Link>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="mt-6">
      <PaginationLinks :paginator="users"/>
    </div>
  </section>
  
</template>
