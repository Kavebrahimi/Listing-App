<script setup>
import { switchTheme, isDark } from "@/theme.js";
import { computed, onMounted, ref } from "vue";
import NavLink from "@/Components/NavLink.vue";
import { usePage } from "@inertiajs/vue3";

const darkMode = ref(null);
onMounted(()=>{
  darkMode.value = isDark()
});
const toggleTheme = ()=>{
  switchTheme();
  darkMode.value = isDark()
}

const page = usePage();
const user = computed(()=> page.props.auth.user);
const show = ref(false);
</script>

<template>
  <!--    Overlay     -->
  <div
      v-show="show"
      @click="show=false"
      class="fixed inset-0 z-40 "
  >

  </div>

  <header class="bg-slate-800 text-white">
    <div class="max-w-4/5 m-auto">
      <nav class="p-6 mx-auto max-w-screen flex justify-between">
        <div class="flex items-center gap-x-2">
          <NavLink routeName="home" componentName="Home">صفحه اصلی</NavLink>
        </div>

        <div class="flex items-center gap-x-6">
          <!--    Auth     -->
          <div v-if="user" class="relative flex items-center gap-x-4">
            <div
                @click="show=!show"
                :class="{'bg-slate-700' : show}"
                class="py-2 px-4 hover:bg-slate-700 rounded-lg flex items-center gap-x-1 transition cursor-pointer"
            >
              <i class="pi pi-angle-down"></i>
              <p>{{ user.full_name }}</p>

            </div>
            <Link v-if="user.role === 'admin'"
                :href="route('admin.index')" 
                class="grid place-items-center rounded-full hover:outline-2 outline-white bg-slate-700 ">
              <i class="pi pi-lock inline-block p-2"></i>
            </Link>
            <!--    User Dropdown Menu     -->
            <transition
                enter-active-class="transition ease-out duration-300"
                enter-from-class="opacity-0 transform -translate-y-4 scale-95"
                enter-to-class="opacity-100 transform translate-y-0 scale-100"
                leave-active-class="transition ease-in duration-200"
                leave-from-class="opacity-100 transform scale-100"
                leave-to-class="opacity-0 transform -translate-y-4 scale-95"
            >
              <div
                  v-show="show"
                  @click="show=false"
                  class="absolute z-50 top-16 right-0 w-36 bg-slate-800 text-shadow-white rounded-lg
                    border-b-slate-300 border overflow-hidden shadow-lg shadow-black/35"
              >
                <Link
                    :href="route('listing.create')"
                    as="button"
                    class="py-2 px-4 block text-start w-full hover:bg-slate-700 transition-colors">
                  ایجاد درخواست
                </Link>
                <Link
                    :href="route('profile.edit')"
                    as="button"
                    class="py-2 px-4 block text-start w-full hover:bg-slate-700 transition-colors">
                  پروفایل
                </Link>
                <Link
                    :href="route('dashboard')"
                    as="button"
                    class="py-2 px-4 block text-start w-full hover:bg-slate-700 transition-colors">
                  داشبورد
                </Link>
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="py-2 px-4 block text-start w-full hover:bg-slate-700 transition-colors">
                  خروج</Link>

              </div>
            </transition>
          </div>

          <!--    Guest     -->
          <div v-else class="flex items-center gap-x-1">
            <NavLink routeName="login" componentName="Auth/Login">ورود</NavLink>
            <NavLink routeName="register" componentName="Auth/Register">ثبت نام</NavLink>
          </div>

          <button
              @click="toggleTheme()"
              class="grid place-items-center rounded-full hover:outline-2 outline-white bg-slate-700 "
          >
          <span v-if="!darkMode">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#fcfcfc" viewBox="0 0 256 256"><path d="M240,96a8,8,0,0,1-8,8H216v16a8,8,0,0,1-16,0V104H184a8,8,0,0,1,0-16h16V72a8,8,0,0,1,16,0V88h16A8,8,0,0,1,240,96ZM144,56h8v8a8,8,0,0,0,16,0V56h8a8,8,0,0,0,0-16h-8V32a8,8,0,0,0-16,0v8h-8a8,8,0,0,0,0,16Zm65.14,94.33A88.07,88.07,0,0,1,105.67,46.86a8,8,0,0,0-10.6-9.06A96,96,0,1,0,218.2,160.93a8,8,0,0,0-9.06-10.6Z"></path></svg>
          </span>
            <span v-else>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#fcfcfc" viewBox="0 0 256 256"><path d="M120,40V16a8,8,0,0,1,16,0V40a8,8,0,0,1-16,0Zm8,24a64,64,0,1,0,64,64A64.07,64.07,0,0,0,128,64ZM58.34,69.66A8,8,0,0,0,69.66,58.34l-16-16A8,8,0,0,0,42.34,53.66Zm0,116.68-16,16a8,8,0,0,0,11.32,11.32l16-16a8,8,0,0,0-11.32-11.32ZM192,72a8,8,0,0,0,5.66-2.34l16-16a8,8,0,0,0-11.32-11.32l-16,16A8,8,0,0,0,192,72Zm5.66,114.34a8,8,0,0,0-11.32,11.32l16,16a8,8,0,0,0,11.32-11.32ZM48,128a8,8,0,0,0-8-8H16a8,8,0,0,0,0,16H40A8,8,0,0,0,48,128Zm80,80a8,8,0,0,0-8,8v24a8,8,0,0,0,16,0V216A8,8,0,0,0,128,208Zm112-88H216a8,8,0,0,0,0,16h24a8,8,0,0,0,0-16Z"></path></svg>
          </span>
          </button>
        </div>

      </nav>
    </div>
  </header>

  <main class="p-6 mx-auto max-w-screen">
    <slot/>
  </main>

</template>
