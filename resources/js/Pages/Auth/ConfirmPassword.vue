<script setup>

import Container from "@/Components/Container.vue";
import Title from "@/Components/Title.vue";
import TextLink from "@/Components/TextLink.vue";
import InputField from "@/Components/InputField.vue";
import PrimaryBtn from "@/Components/PrimaryBtn.vue";
import CheckBox from "@/Components/CheckBox.vue";
import { Form } from "@inertiajs/vue3";
import SessionMessage from "@/Components/SessionMessage.vue";

</script>

<template>
  <Head title="| تائید رمز"/>
  <Container class="w-1/3 m-auto">

    <div class="mb-8 text-center">
      <p>لطفا برای ادامه رمزعبور خود را وارد کنید.</p>
    </div>

    <Form
        reset-on-error
        :action="route('password.confirm')"
        method="post"
        class="space-y-4"
        v-slot="{ processing, errors }"
    >
      <InputField
          type="password"
          inputLabel="رمزعبور"
          icon="lock"
          name="password"
          :error="errors.password"
          id="password"
      />

      <PrimaryBtn :disabled="processing">
        <span v-if="!processing">ادامه</span>
        <span v-else>درحال بررسی</span>
      </PrimaryBtn>

    </Form>
  </Container>
</template>
