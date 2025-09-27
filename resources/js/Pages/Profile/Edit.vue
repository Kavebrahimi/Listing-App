<script setup >

import UpdateInfo from "@/Pages/Profile/Partials/UpdateInfo.vue";
import UpdatePassword from "@/Pages/Profile/Partials/UpdatePassword.vue";
import DeleteAccount from "@/Pages/Profile/Partials/DeleteAccount.vue";

defineProps({
  user: Object,
  status: String
});

</script>

<template>
  <Head title="| پروفایل"/>

  <UpdateInfo :user="user" :status="status"/>
  <UpdatePassword/>
  <DeleteAccount/>

</template>
