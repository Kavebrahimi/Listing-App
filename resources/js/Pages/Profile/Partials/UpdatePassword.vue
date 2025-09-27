<script setup>
import Container from "@/Components/Container.vue";
import Title from "@/Components/Title.vue";
import { Form, useForm } from "@inertiajs/vue3";
import InputField from "@/Components/InputField.vue";
import PrimaryBtn from "@/Components/PrimaryBtn.vue";



const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: ''
});



</script>

<template>
  <Container class="mb-6">
    <div class="mb-6">
      <Title>بروزرسانی رمزعبور</Title>
      <p>از داشتن رمزعبوری طولانی و قدرتمند اطمینان حاصل کنید.</p>

    </div>

    <Form
        method="put"
        resetOnSuccess
        resetOnError
        :options="{ preserveScroll: true }"
        :action="route('profile.password')"
        :form="form"
        class="space-y-5"
        v-slot="{ processing , errors, recentlySuccessful }"
    >
      <InputField
          name="current_password"
          type="password"
          v-model="form.current_password"
          inputLabel="رمزعبور فعلی"
          icon="lock"
          class="lg:w-1/3 sm:w-full"
          :error="errors.current_password"
          id="current_password"
      />
      <InputField
          name="password"
          type="password"
          v-model="form.password"
          inputLabel="رمزجدید"
          icon="lock"
          class="lg:w-1/3 sm:w-full"
          :error="errors.password"
          id="password"
      />
      <InputField
          name="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          inputLabel="تائید رمز"
          icon="lock"
          class="lg:w-1/3 sm:w-full"
          :error="errors.password_confirmation"
          id="password_confirmation"
      />

      <p v-if="recentlySuccessful" class="text-green-500 dark:text-green-300">رمزعبور با موفقیت بروزرسانی شد!</p>

      <PrimaryBtn :disabled="processing">ذخیره</PrimaryBtn>
    </Form>
  </Container>
</template>
