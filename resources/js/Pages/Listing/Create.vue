<script setup >

import { useForm } from "@inertiajs/vue3";
import Container from '@/Components/Container.vue';
import Title from "@/Components/Title.vue";
import InputField from "@/Components/InputField.vue";
import PrimaryBtn from "@/Components/PrimaryBtn.vue";
import TextArea from "@/Components/TextArea.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import ErrorMessage from "@/Components/ErrorMessage.vue";

const form = useForm({
  'title': null,
  'desc': null,
  'tags': null,
  'email': null,
  'link': null,
  'image': null,
});

</script>

<template>
  <Head title="| درخواست جدید"/>

  <Container class="w-4/5 m-auto">
    
    <div class="mb-6">
      <Title>ساخت درخواست جدید</Title>
    </div>

    <ErrorMessage :errors="form.errors"/>

    <form @submit.prevent="form.post(route('listing.store'))" class="grid grid-cols-2 gap-6">
      <div class="space-y-6">
        <InputField
          inputLabel="موضوع"
          icon="receipt"
          placeholder="درخواست من..."
          v-model="form.title"
        />
        <InputField
            inputLabel="تگ ها (با , جداشود)"
            icon="tag"
            placeholder="تگ 1 , تگ 2 , تگ 3 .."
            v-model="form.tags"
        />
        <TextArea
            inputLabel="توضیحات"
            icon="align-right"
            placeholder="من قدم زد تو ساحلو..."
            v-model="form.desc"
        />
      </div>

      <div class="space-y-6">
        <InputField
            inputLabel="ایمیل"
            icon="at"
            placeholder="unknown@examplde.com"
            v-model="form.email"
        />
        <InputField
            inputLabel="لینک خارجی"
            icon="external-link"
            placeholder="https://example.com"
            v-model="form.link"
        />
        <ImageUpload @image="(e)=> form.image = e "/>
      </div>

      <div>
        <PrimaryBtn :disabled="form.processing">ایجاد</PrimaryBtn>
      </div>
    </form>
    
  </Container>

</template>
