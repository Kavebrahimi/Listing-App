<script setup>

import { Link, router } from "@inertiajs/vue3";

const params = route().params


defineProps({
  listing: Object
});

const selectUser = (id)=>{
  router.get(route('home'), {
    user_id: id,
    search: params.search,
    tag: params.tag
  })
}
const selectTag = (tag)=>{
  router.get(route('home'), {
    user_id: params.user_id,
    search: params.search,
    tag: tag
  })
}

</script>

<template>

  <div class="bg-white rounded-lg shadow-lg overflow-hidden
             dark:bg-slate-800 h-full flex flex-col justify-between"
  >
    <div>
      <!--    Image     -->
      <Link :href="route('listing.show', listing.id)" class="w-full h-48">
        <img
            :src="listing.image ? `/storage/${listing.image}` : `/storage/images/listings/default.jpg` "
            alt=""
            class=" bg-slate-300 object-cover object-center h-48 w-full">
      </Link>
      <!--    Title & User     -->
      <div class="p-4">
        <h3 class="font-bold text-xl mb-2">
          {{ listing.title.substring(0, 40) }}...
        </h3>
        <p>
          لیست شده در
          {{
            new Date(listing.created_at).toLocaleDateString("fa-IR-u-ca-persian", {
              year: "numeric",
              month: "long",
              day: "2-digit",
              hour: "2-digit",
              minute: "2-digit"
            })
          }}
          <br>
          <button
              @click="selectUser(listing.user.id)"
              type="button"
              class="text-link"
          >
            {{ listing.user.full_name }}
          </button>
        </p>
      </div>
    </div>
    <!--    Tags     -->
    <div class="flex items-center gap-x-2 p-4" v-if="listing.tags">
      <div v-for="tag in listing.tags.split(',')" :key="tag">
        <button
            @click="selectTag(tag)"
            class="py-0.5 px-2 text-white bg-indigo-500 rounded-2xl hover:bg-indigo-700"
        >
          {{ tag }}
        </button>
      </div>
    </div>
  </div>

</template>
