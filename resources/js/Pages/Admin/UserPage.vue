<script setup>

import Title from "@/Components/Title.vue";
import { router, useForm } from "@inertiajs/vue3";
import InputField from "@/Components/InputField.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import SessionMessage from "@/Components/SessionMessage.vue";

const props = defineProps({
  user: Object,
  listings: Object,
  status: String
  
})

const params = route().params;

const form = useForm({
  search: params.search,  
});

const search = ()=>{
  router.get(route('user.show', {
    user: props.user.id,
    search: form.search,

  }))
}

const showDisapproved = (e)=>{
  if (e.target.checked) {
    router.get(route('user.show', {
      user: props.user.id,
      search: params.search,
      disapproved: true
    }))
  } else {
    router.get(route('user.show', {
      user: props.user.id,
      search: params.search,
      disapproved: null
    }))
  }
}

const toggleApprove = (listing)=>{
  let msg = listing.approved ? 'رد کردن این درخواست؟' : 'تائید این درخواست؟';
  if (confirm(msg)) {
    router.put(route('admin.approve', listing.id))
  }
}

</script>

<template>
  
  <Head :title="`| درخواست های ${user.full_name}`"/>
  
  <section class="w-4/5 m-auto">
    <div>
      <SessionMessage :status="status"/>
    </div>
    <!--    Heding     -->
    <div class="mb-6">
      <Title> درخواست های {{ user.full_name }}</Title>
      <div class="flex items-end justify-between">
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
              :href="route('user.show', { ...params, search:null, page:null, user: user.id })"
          >
            <span>{{ params.search }}</span>
            <i class="pi pi-times text-xs"></i>
          </Link>
        </div>
        <!--    Toggle Approve Listings Btn     -->
        <div class="flex items-center  gap-1 text-xs rounded-md
                  hover:bg-slate-300 dark:hover:bg-slate-800 px-2 py-1"
        >
          <input
              @input="showDisapproved"
              :checked="params.disapproved"
              class="rounded-md border-1 outline-0 text-indigo-500
                  ring-indigo-500 border-slate-700 cursor-pointer"
              type="checkbox"
              id="showDisapproved"
          >
          <label for="showDisapproved" class="block text-sm font-medium 
                    text-slate-700 dark:text-slate-300 cursor-pointer">
            نمایش لیست های رد شده
          </label>
        </div>
      </div>
    </div>  

    <!--    Admin     -->
    <table class="bg-white dark:bg-slate-800 w-full rounded-lg overflow-hidden ring-1 ring-slate-300">
      
      <thead>
        <tr class="bg-slate-600 text-slate-300 uppercase text-xs text-right">
          <th class="w-4/6 p-3">موضوع</th>
          <th class="w-2/6 p-3 text-center">تائید شده</th>
          <th class="w-1/6 p-3">نمایش</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-300 divide-dashed">
        <tr v-for="listing in listings.data" :key="listing.id">
          <td class="py-5 px-3">{{ listing.title }}</td>
          <td class="py-5 px-3 text-2xl text-center">
            <button @click.prevent="toggleApprove(listing)">
              <i :class="`pi pi-${
                listing.approved ? 'check-circle text-green-500'
                : 'times-circle text-red-500'
              }`"></i>
            </button>
          </td>
          <td class="w-1/6 py-5 px-3 text-left">
            <Link
                class="pi pi-external-link"
                :href="route('listing.show', listing.id)"
            ></Link>
          </td>
        </tr>
      </tbody>
      
    </table>
    
    <div class="mt-6">
      <PaginationLinks :paginator="listings"/>
    </div>
    
  </section>
  
</template>
