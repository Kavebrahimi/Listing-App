<script setup xmlns="http://www.w3.org/1999/html">
import Container from "@/Components/Container.vue";
import Title from "@/Components/Title.vue";
import { Form, useForm } from "@inertiajs/vue3";
import InputField from "@/Components/InputField.vue";
import PrimaryBtn from "@/Components/PrimaryBtn.vue";
import { ref } from "vue";

const showDelete = ref(false);

</script>

<template>
  <Container class="mb-6">
    <div class="mb-6">
      <Title>حذف حساب کاربری</Title>
      <p>حساب شما یکبار برای همیشه با تمامی اطلاعات پاک خواهد شد, لطفا اطمینان حاصل کنید.</p>

    </div>

    <Transition
        enter-active-class="transition-all duration-300 ease-out"
        enter-from-class="opacity-0 -translate-y-4 scale-y-95 max-h-0"
        enter-to-class="opacity-100 translate-y-0 scale-y-100 max-h-[500px]"
        leave-active-class="transition-all duration-200 ease-in"
        leave-from-class="opacity-100 translate-y-0 scale-y-100 max-h-[500px]"
        leave-to-class="opacity-0 -translate-y-4 scale-y-95 max-h-0"
    >
      <div v-if="showDelete">
        <Form
            method="delete"
            :reset-on-error="['password']"
            rese
            :options="{ preserveScroll: true }"
            :form="form"
            :action="route('profile.destroy')"
            class="flex flex-col gap-y-4"
            v-slot="{ processing , errors }"
        >
          <InputField
              name="password"
              type="password"
              inputLabel="تائید رمز"
              icon="lock"
              class="lg:w-1/3 sm:w-full"
              :error="errors.password"
              id="password"
          />

          <div class="space-x-5 flex items-center">
            <PrimaryBtn :disabled="processing">تائید</PrimaryBtn>
            <button
                class="hover:text-red-500"
                @click="showDelete = false">
              لغو
            </button>
          </div>
        </Form>
      </div>
    </Transition>

    <Transition
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
      <button
          v-if="!showDelete"
          @click="showDelete = true"
          class="flex items-center gap-x-1 bg-red-500 text-white hover:bg-red-400 py-2 px-4 rounded-lg">
        <span>حذف حساب</span>
        <i class="pi pi-exclamation-triangle"></i>
      </button>
    </Transition>

  </Container>
</template>
