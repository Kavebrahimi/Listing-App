<script setup>

import Container from "@/Components/Container.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  listing: Object,
  user: Object,
  'canModify': Boolean,
});

const deleteListing = ()=>{
  if (confirm('از پاک کردن این درخواست مطمئنی؟')) {
    router.delete(route('listing.destroy', props.listing.id))
  }
}

const toggleApprove = ()=>{
  let msg = props.listing.approved ? 'رد کردن این درخواست؟' : 'تائید این درخواست؟';
  if (confirm(msg)) {
    router.put(route('admin.approve', props.listing.id))
  }
}

</script>

<template>

  <Head title="| جزئیات درخواست"/>
  <!--    Admin     -->
  <div v-if="$page.props.auth.user.role === 'admin' "
       class="bg-slate-800 text-white mb-6 p-6 rounded-md font-medium flex items-center justify-between w-4/5 m-auto"
  >
    <p>این درخواست {{ listing.approved ? 'تائید شده' : 'رد شده' }}</p>
    <button @click.prevent="toggleApprove" 
        class="bg-slate-600 px-3 py-1 rounded-md">
      {{ listing.approved ? 'ردکردن' : 'تائید' }}
    </button>
  </div>
  <Container class="w-4/5 m-auto flex gap-4">
    
    <div class="w-1/5 rounded-md overflow-hidden">
      <img 
          :src="listing.image ? `/storage/${listing.image}` 
          : '/storage/images/listings/default.jpg' " 
          alt=""
          class="w-full h-full object-center object-cover"
      >
    </div>
    
    <div class="w-3/4">
      <!--    Listing details     -->
      <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
          <p class="text-slate-400 w-full border-b">جزئیات درخواست</p>

          <!--    Listing Delete & Edit     -->
          <div class="pr-4 flex items-center gap-4" v-if="canModify">
            <Link 
                :href="route('listing.edit', listing.id)"
                class="bg-green-500 rounded-md text-white px-6 py-2 hover:outline outline-green-500 outline-offset-2"
            >
              ویرایش
            </Link>
            <button
                @click="deleteListing"
                class="bg-red-500 rounded-md text-white px-6 py-2 hover:outline outline-red-500 outline-offset-2"
            >
              حذف
            </button>
          </div>
        </div>
        
        <h3 class="font-bold text-2xl mb-4">{{ listing.title }}</h3>
        <p>{{ listing.desc }}</p>
      </div>
      <!--    Contact info     -->
      <div class="mb-6">
        <p class="text-slate-400 w-full border-b mb-2">اطلاعات تماس</p>
        
        <div
            v-if="listing.email"
            class="flex items-center mb-2 gap-2"
        >
          <i class="pi pi-at"></i>
          <span>ایمیل:</span>
          <a :href="`mailto:${listing.email}`" class="text-link">{{ listing.email }}</a>
        </div>
        <div
            v-if="listing.link"
            class="flex items-center mb-2 gap-2"
        >
          <i class="pi pi-external-link"></i>
          <span>لینک خارجی:</span>
          <a :href="listing.link" target="_blank" class="text-link">{{ listing.link }}</a>
        </div>
        <div
            class="flex items-center mb-2 gap-2"
        >
          <i class="pi pi-user"></i>
          <span>درخواست شده توسط:</span>
          <Link :href="route('home', {user_id : listing.user.id})" class="text-link">{{ user.full_name }}</Link>
        </div>
        
      </div>
      <div v-if="listing.tags" class="mb-6">
        <p class="text-slate-400 w-full border-b mb-2">تگ ها</p>
        
        <div class="flex items-center gap-3">
          <div v-for="tag in listing.tags.split(',')" :key="tag">
            <Link
                :href="route('home', { tag })"
                class="py-0.5 px-2 text-white bg-indigo-500 rounded-2xl hover:bg-indigo-700"
            >
              {{ tag }}
            </Link>
          </div>
        </div>
      </div>
    </div>
  </Container>
  
</template>
