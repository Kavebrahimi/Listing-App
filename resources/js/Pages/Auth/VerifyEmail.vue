<script setup>

import Container from "@/Components/Container.vue";
import { Form } from "@inertiajs/vue3";
import PrimaryBtn from "@/Components/PrimaryBtn.vue";
import SessionMessage from "@/Components/SessionMessage.vue";
import { ref } from "vue";

defineProps({
  status: String
});

const disabled = ref(false);
const timer = ref(0);

function handleSend(processing) {
  if (processing) return;
  disabled.value = true;
  timer.value = 60;
  const countDown = setInterval(()=>{
    timer.value--;
    if (timer.value <= 0) {
      disabled.value = false
      clearInterval(countDown)
    }
  }, 1000)
}


</script>

<template>

  <Head title="| تائید ایمیل"/>

  <Container class="w-1/3 m-auto">

    <div class="mb-8">
      <p>
        خوش اومدی به اپلیکیشن ما, قبل از شروع کردن میشه با استفاده از لینکی که برات ایمیل شده ایمیلتو تائید کنی؟
        اگه لینکی دریافت نکردی میتونیم برات دوباره بفرستیم. :)
      </p>
    </div>

    <SessionMessage :status="status"/>

    <Form
        method="post"
        :action="route('verification.send')"
        v-slot="{processing, errors}"
        @submit.prevent="handleSend(processing)"
    >
      <PrimaryBtn :disabled="disabled || processing">
        <span v-if="processing">درحال ارسال</span>
        <span v-else-if="timer > 0">لطفا صبر کنید {{ timer }}</span>
        <span v-else>ارسال مجدد لینک</span>
      </PrimaryBtn>
    </Form>

  </Container>

</template>
