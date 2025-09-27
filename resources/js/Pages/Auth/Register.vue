<script setup>

import Container from "@/Components/Container.vue";
import Title from "@/Components/Title.vue";
import TextLink from "@/Components/TextLink.vue";
import InputField from "@/Components/InputField.vue";
import PrimaryBtn from "@/Components/PrimaryBtn.vue";
import { Form, useForm } from "@inertiajs/vue3";

</script>

<template>
  <Head title="| ثبت نام"/>
  <Container class="lg:w-1/3 sm:w-full m-auto">

    <div class="mb-8 text-center">
      <Title>ساخت حساب کاربری</Title>
      <p>
        ثبت نام کردی؟
        <TextLink routeName="login">ورود به حساب</TextLink>
      </p>
    </div>

    <Form
        :reset-on-error="['password', 'password_confirmation']"
        :action="route('register')"
        method="post"
        v-slot="{processing, errors}"
        class="space-y-4"
    >

      <InputField
          type="text"
          inputLabel="نام"
          icon="id-card"
          name="full_name"
          placeholder="کاوه ابراهیمی"
          :error="errors.full_name"
          id="full_name"
      />
      <InputField
          type="email"
          inputLabel="ایمیل"
          icon="at"
          name="email"
          placeholder="jonDoe@example.com"
          :error="errors.email"
          id="email"
      />
      <InputField
          type="password"
          inputLabel="رمزعبور"
          icon="lock"
          name="password"
          :error="errors.password"
          id="password"
      />
      <InputField
          type="password"
          inputLabel="تائید رمز"
          icon="check-circle"
          name="password_confirmation"
          :error="errors.password_confirmation"
          id="password_confirmation"
      />
      <p class="text-sm text-indigo-500 dark:text-slate-400 w-5/6 leading-6 ">با ایجاد حساب کاربری، شما با شرایط و ضوابط و خدمات و سیاست حفظ حریم خصوصی ما موافقت می‌کنید. </p>
      <PrimaryBtn :disabled="processing">
        <span v-if="!processing">ثبت نام</span>
        <span v-else>درحال ارسال</span>
      </PrimaryBtn>

    </Form>
  </Container>
</template>
