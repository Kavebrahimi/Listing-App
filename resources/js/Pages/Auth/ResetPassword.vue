<script setup>

import Container from "@/Components/Container.vue";
import Title from "@/Components/Title.vue";
import InputField from "@/Components/InputField.vue";
import PrimaryBtn from "@/Components/PrimaryBtn.vue";
import { Form } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
  token: String,
  email: String
});

const email = ref(props.email);

</script>

<template>
  <Head title="| بازنشانی رمز"/>
  <Container class="w-1/3 m-auto">

    <div class="mb-8 text-center">
      <Title>ساخت رمزعبور جدید</Title>
    </div>

    <Form
        :action="route('password.update')"
        method="post"
        v-slot="{processing, errors}"
        class="space-y-4"

    >
      <input type="hidden" name="token" :value="props.token">
      <InputField
          type="email"
          inputLabel="ایمیل"
          icon="at"
          name="email"
          placeholder="jonDoe@example.com"
          :error="errors.email"
          v-model="email"
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
      <PrimaryBtn :disabled="processing">
        <span v-if="!processing">تغییر رمز</span>
        <span v-else>درحال تغییر</span>
      </PrimaryBtn>

    </Form>
  </Container>
</template>
