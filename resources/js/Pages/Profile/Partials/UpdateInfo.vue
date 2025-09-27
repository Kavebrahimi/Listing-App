<script setup>
import Container from "@/Components/Container.vue";
import Title from "@/Components/Title.vue";
import { Form, useForm, router } from "@inertiajs/vue3";
import InputField from "@/Components/InputField.vue";
import PrimaryBtn from "@/Components/PrimaryBtn.vue";
import SessionMessage from "@/Components/SessionMessage.vue";

const props = defineProps({
  user: Object,
  status: String
});

const form = useForm({
  full_name: props.user.full_name ,
  email: props.user.email
});


const resendEmail = (e) => {
  router.post(route('verification.send'), {}, {
    onStart: () => e.target.disabled = true,
    onFinish: () => e.target.disabled = false,
  });
};
</script>

<template>
  <Container class="mb-6">
    <div class="mb-6">
      <Title>بروزرسانی اطلاعات</Title>
      <p>اطلاعات پروفایل و ایمیل خودتو بروزرسانی کن.</p>

    </div>

    <Form
        :form="form"
        reset-on-success
        method="patch"
        :action="route('profile.info')"
        class="space-y-5"
        v-slot="{ processing , errors}"
    >
      <InputField
          name="full_name"
          v-model="form.full_name"
          inputLabel="نام"
          icon="id-card"
          class="lg:w-1/3 sm:w-full"
          :error="errors.full_name"
          id="full_name"
      />

      <InputField
          name="email"
          v-model="form.email"
          type="email"
          inputLabel="ایمیل"
          icon="at"
          class="lg:w-1/3 sm:w-full"
          :error="errors.email"
          id="email"
      />

      <div class="space-y-1">
        <div class="flex items-center gap-x-2" v-if="!props.user.email_verified_at">
          <p>ایمیل شما تائید نشده.</p>
          <button
              @click="resendEmail"
              type="button"
              class="text-indigo-500 font-medium dark:text-indigo-300 disabled:text-slate-400 disabled:cursor-wait"
          >
            برای ارسال لینک تائید کلیک کنید.
          </button>
        </div>
        <SessionMessage :status="status"/>
      </div>

      <PrimaryBtn :disabled="processing">ذخیره</PrimaryBtn>
    </Form>
  </Container>
</template>
