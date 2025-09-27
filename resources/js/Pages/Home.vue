<script setup>

import Card from "@/Components/Card.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import InputField from "@/Components/InputField.vue";
import { router, useForm } from "@inertiajs/vue3";

const params = route().params

const props = defineProps({
      listings: Object,
      searchTerm: String
});
const username = params.user_id ? props.listings.data.find(
    i=> i.user_id === Number(params.user_id)).user.full_name : null;

const form = useForm({
  search: props.searchTerm
});
const search = ()=>{
  router.get(route('home'), {
    search: form.search,
    user_id: params.user_id,
    tag: params.tag
  });
}
</script>

<template>
  <Head title="| صفحه اصلی"/>

  <div class="flex items-center justify-between mb-5 lg:w-4/5 sm:w-full m-auto">

    <div class="lg:w-1/4 sm:w-full">
      <form @submit.prevent="search">
        <InputField
            v-model="form.search"
            type="search"
            placeholder="جستجو ..."
            icon="search"
        />
      </form>
    </div>

    <div class="flex items-center gap-x-2">

      <Link
          class="flex items-center gap-x-0.5 py-0.5 px-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-700"
          v-if="params.tag"
          :href="route('home', { ...params, tag:null, page:null })"
      >
        <span>{{ params.tag }}</span>
        <i class="pi pi-times text-xs"></i>
      </Link>

      <Link
          class="flex items-center gap-x-0.5 py-0.5 px-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-700"
          v-if="params.user_id"
          :href="route('home', { ...params, user_id: null, page:null })"
      >
        <span>{{ username }}</span>
        <i class="pi pi-times text-xs"></i>
      </Link>

      <Link
          class="flex items-center gap-x-0.5 py-0.5 px-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-700"
          v-if="params.search"
          :href="route('home', { ...params, search:null, page:null })"
      >
        <span>{{ params.search }}</span>
        <i class="pi pi-times text-xs"></i>
      </Link>

    </div>

  </div>

  <div class="lg:w-4/5 sm:w-full m-auto" v-if="listings.data.length">
    <div class="grid lg:grid-cols-3 gap-6 sm:grid-cols-1">
      <div v-for="listing in listings.data" :key="listing.id">
        <Card :listing="listing"/>
      </div>
    </div>

    <div class="mt-10">
      <PaginationLinks :paginator="listings"/>
    </div>

  </div>
  <div class="lg:w-4/5 sm:w-full m-auto" v-else>
    هیچ آیتمی وجود ندارد
  </div>

</template>
