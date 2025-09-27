<script setup>

import { ref } from "vue";

const emit = defineEmits(['image']);
const props = defineProps({ listingImage: String });
const currentImage = props.listingImage ? `/storage/${props.listingImage}` : null;
const preview = ref(currentImage);
const overSizedImage = ref(false);
const undoBtn = ref(false);

const imageSelected = (e)=> {
  preview.value = URL.createObjectURL(e.target.files[0])
  overSizedImage.value = e.target.files[0].size > 3145728;
  undoBtn.value = true; 
  emit('image', e.target.files[0]);
};
const undoImage = (e)=>{
  undoBtn.value = false;
  preview.value = currentImage;
  overSizedImage.value = false;
  emit('image', null);
};

</script>

<template>

  <div class="space-y-2">
    <span
        class="block text-sm font-medium text-slate-700 dark:text-slate-300"
        :class="{'!text-red-500' : overSizedImage}"
    >
      {{ overSizedImage ? 'عکس انتخاب شده بیشتر از حد تعیین شده است !' : 'برای درخواستت پس زمینه انتخاب کن (حداکثر سایز 3 مگابایت)' }}
    </span>
    <label
        for="image"
        class="relative block rounded-md mt-1 bg-slate-300 h-[140px] overflow-hidden cursor-pointer border-slate-300 border"
        :class="{'!border-red-500' : overSizedImage}"
    >
      <img :src="preview ?? '/storage/images/listings/default.jpg'"
           class="object-cover object-center h-full w-full"
           alt=""
      >
      <button 
          type="button" 
          v-if="undoBtn" 
          @click.prevent="undoImage"
          class="absolute top-2 right-2 bg-white/75 w-8 h-8 
                rounded-full grid place-items-center text-slate-700"
      >
        <i class="pi pi-undo"></i>
      </button>
    </label>
    <input @input="imageSelected" type="file" name="image" id="image" hidden>
  </div>

</template>
