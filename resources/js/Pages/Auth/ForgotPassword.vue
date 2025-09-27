<script setup>

import Container from "@/Components/Container.vue";
import InputField from "@/Components/InputField.vue";
import PrimaryBtn from "@/Components/PrimaryBtn.vue";
import { Form } from "@inertiajs/vue3";
import SessionMessage from "@/Components/SessionMessage.vue";

defineProps({
  status: String
});

</script>

<template>
  <Head title="| فراموشی رمز"/>
  <Container class="w-1/3 m-auto">

    <div class="mb-8">
      <p>رمزتو یادت رفته؟ مشکلی نداره فقط با داشتن ایمیل خودت ما میتونیم برات لینک بازنشانی رمزو بفرستیم :)</p>
    </div>

    <Form
        :action="route('password.email')"
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

      <SessionMessage :status="status"/>

      <PrimaryBtn :disabled="processing">
        <span v-if="!processing">ارسال لینک بازنشانی</span>
        <span v-else>درحال ارسال</span>
      </PrimaryBtn>

    </Form>
  </Container>
</template>
