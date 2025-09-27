<script setup>

import Container from "@/Components/Container.vue";
import Title from "@/Components/Title.vue";
import TextLink from "@/Components/TextLink.vue";
import InputField from "@/Components/InputField.vue";
import PrimaryBtn from "@/Components/PrimaryBtn.vue";
import CheckBox from "@/Components/CheckBox.vue";
import { Form } from "@inertiajs/vue3";
import SessionMessage from "@/Components/SessionMessage.vue";

defineProps({
  status: String
});

</script>

<template>
  <Head title="| ورود"/>
  <Container class="w-1/3 m-auto">

    <div class="mb-8 text-center">
      <Title>ورود به حساب</Title>
      <p>
        ثبت نام نکردی؟
        <TextLink routeName="register">ساخت حساب</TextLink>
      </p>
    </div>

    <Form
        :reset-on-error="['password']"
        :action="route('login')"
        method="post"
        class="space-y-4"
        v-slot="{ processing, errors }"
    >

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

      <SessionMessage :status="status"/>

      <div class="flex items-center justify-between">

        <CheckBox name="remember">منو یادت نره</CheckBox>
        <TextLink routeName="password.request">رمزعبورتو یادت رفته؟</TextLink>

      </div>

      <PrimaryBtn :disabled="processing">
        <span v-if="!processing">ورود</span>
        <span v-else>درحال ارسال</span>
      </PrimaryBtn>

    </Form>
  </Container>
</template>
