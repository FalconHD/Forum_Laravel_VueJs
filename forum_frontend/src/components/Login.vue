<template lang="">
        <div class="row">
    <div class="col s12 ">
      <div class="card">
        <div class="card-content white-text all">
          <span class="card-title">Sign in</span>
          <div class="row">
          <form class="col s12 " @submit.prevent>
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <input v-model="email" id="email" type="email" class="validate">
                <label for="email">Email</label>
              </div>
              <div class="input-field col s12">
                <i class="material-icons prefix">password</i>
                <input v-model="password" id="password" type="password" class="validate">
                <label for="password">Password</label>
              </div>
            </div>
            <a class="waves-effect waves-light btn" @click="startLogin">LOGIN NOW</a>
          </form>
        </div>
        </div>
        <div class="card-action centerit">
        <router-link to="/Register">or Sign up --></router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { ref } from "vue";
import Api from "@/hooks/Api.js";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default {
  setup() {
    let email = ref("");
    let password = ref("");
    const store = useStore();
    const route = useRouter();
    const startLogin = async () => {
      let loginData = {
        email: email.value,
        password: password.value,
      };
      console.log(loginData);
      let result = await Api.post("/login", loginData);
      if (!result.error) {
        store.state.logged = true;
        result.User.type == 1
          ? (store.state.type = "normal")
          : (store.state.type = "admin");
        store.state.User = result.User;
        localStorage.setItem("Token", result.Token);
        localStorage.setItem("user_id", result.User.id);
        route.push("/");
      } else {
        alert(result.error);
      }
    };

    return {
      email,
      password,
      startLogin,
    };
  },
};
</script>
<style lang="css" scoped>
.all {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin: 20px;
}
.centerit {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.card {
  background-color: #282447;
}
</style>