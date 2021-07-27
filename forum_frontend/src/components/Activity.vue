<template lang="">
    <div>
        {{user}}
    </div>
</template>
<script>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import Api from "@/hooks/Api.js";
export default {
  setup() {
    const user = ref([]);
    const {
      params: { id },
    } = useRoute();

    const getUserInfos = async () => {
      let token = localStorage.getItem("Token");
      let result = await Api.get(`/user/${id}`, token);
      user.value = result;
      console.log(user.value);
    };

    onMounted(() => {
      getUserInfos();
    });
    return {
      user,
    };
  },
};
</script>
<style lang="css" scoped>
</style>