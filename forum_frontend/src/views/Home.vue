<template>
  <div class="home">
    <Main  />
  </div>
</template>

<script>
import Main from "@/components/Main.vue";
import { onMounted } from "vue";
// import { useRouter } from "vue-router";
import { useStore } from "vuex";
export default {
  name: "Home",
  components: {
    Main,
  },
  setup() {
    const store = useStore();
    // const route = useRouter();

    onMounted(() => {
      if (!store.state.logged) {
        // route.push("/Login");
      }
    });
  },
};
</script>
