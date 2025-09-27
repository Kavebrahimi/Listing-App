<script setup >

import Title from "@/Components/Title.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import { router } from "@inertiajs/vue3";
import SessionMessage from "@/Components/SessionMessage.vue";

defineProps({
  listings: Object,
  status: String
});

const deleteListing = (id)=>{
  if (confirm('آیا مطمئین هستید؟')) {
    router.delete(route('listing.destroy', id))
  }
};

</script>

<template>
  
  <Head title="| داشبورد"/>
  
  <section class="w-4/5 m-auto">
    <SessionMessage :status/>
    <div v-if="listings">
      <div v-if="Object.keys(listings.data).length">
        <div class="mb-6">
          <!--    Heading     -->
          <div class="flex items-center justify-between mb-4">
            <Title>آخرین درخواست های شما</Title>
            <div class="flex items-center gap-4 text-sm">
              <p class="text-green-500">تائید شده <i class="pi pi-check-circle"></i></p>
              <p class="text-red-500">در انتظار تأیید <i class="pi pi-times-circle"></i></p>
            </div>
          </div>
          <!--    Table     -->
          <table class="w-full table-fixed border-collapse overflow-hidden
                     rounded-md text-sm ring-1 ring-slate-300 dark:bg-slate-800
                     dark:ring-slate-600 bg-white shadow-lg">

            <thead class="bg-slate-300 text-xs uppercase text-slate-600
                       dark:text-slate-400 dark:bg-slate-900">
            <tr>
              <th class="w-3/4 p-3 text-right ">موضوع درخواست</th>
              <th class="w-1/4 py-3 pl-3 text-left">نمایش</th>
              <th class="w-1/5 py-3 pl-3 text-left">ویرایش</th>
              <th class="w-1/5 py-3 pl-3 text-left">حذف</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="listing in listings.data" :key=listing.id
                class="border-b border-slate-200 hover:bg-slate-100
                      dark:bg-slate-800 dark:hover:bg-slate-700 dark:border-slate-600">

              <td class="w-3/4 p-3 text-right ">
                <div class="flex items-center gap-2">
                  <img
                      :src="listing.image ? `/storage/${listing.image}` : '/storage/images/listings/default.jpg'"
                      class="w-10 h-10 rounded-full object-cover object-center"
                      alt="">
                  <h4 class="font-bold flex items-center gap-x-1">
                    {{ listing.title }}
                    <i :class="`pi pi-${listing.approved ? 'check-circle text-green-500' : 'times-circle text-red-500'}`"></i>
                  </h4>
                </div>
              </td>

              <td class="w-1/4 py-3 pl-3 text-left text-indigo-400">
                <Link v-if="listing.approved"
                      :href="route('listing.show', listing.id)">نمایش</Link>
              </td>

              <td class="w-1/5 py-3 pl-3 text-left text-indigo-400">
                <Link :href="route('listing.edit', listing.id)">ویرایش</Link>
              </td>

              <td class="w-1/4 py-3 pl-3 text-left text-red-400">
                <button type="button" @click="deleteListing(listing.id)">حذف</button>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <div>
          <PaginationLinks :paginator="listings"/>
        </div>
      </div>
      <div v-else>
        شما هیچ درخواستی ندارید.
      </div>
    </div>
    <div v-else class="flex flex-col gap-y-2">
      <p>به دلیل رعایت نکردن قوانین سایت,  حساب شما به حالت تعلیق درآمده است. </p>
      <p> باما تماس بگیرید:<span class="text-link">shop@email.com</span></p>
    </div>
  </section>
  
</template>
