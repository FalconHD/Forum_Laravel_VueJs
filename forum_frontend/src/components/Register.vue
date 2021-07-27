<template lang="">
        <div class="row">
    <div class="col s12 ">
      <div class="card">
        <div class="card-content white-text all">
          <span class="card-title">Sign in</span>
          <div class="row">
          <form class="col s12 ">
            <div class="row">
              
              <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input v-model="name" id="Name" type="text" class="white-text">
                <label for="Name">Name</label>
              </div>
              <div class="input-field col s6">
                <i class="material-icons prefix">email</i>
                <input v-model="email" id="email" type="email" class="validate white-text">
                <label for="email">Email</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <i class="material-icons prefix">password</i>
                <input v-model="password" id="Password" type="Password" class="validate white-text">
                <label for="Password">Password</label>
              </div>
              <div class="input-field col s6">
                <i class="material-icons prefix">password_confirmation</i>
                <input v-model="password_confirmation" id="password_confirmation" type="password" class="validate white-text" >
                <label for="password_confirmation">password confirmation</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea v-model="bio" id="textarea2" class="materialize-textarea white-text" data-length="120" ></textarea>
                <label for="textarea2">Bio</label>
              </div>
            </div>
            <a class="waves-effect waves-light btn" @click="startRegister">REGISTER NOW</a>
          </form>
        </div>
        </div>
        <div class="card-action centerit">
        <router-link to="/Login">or Sign up --></router-link>
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
    const name = ref("");
    const email = ref("");
    const bio = ref("");
    const password = ref("");
    const password_confirmation = ref("");

    const store = useStore();
    const route = useRouter();
    const startRegister = async () => {
      let registerData = {
        name: name.value,
        email: email.value,
        bio: bio.value,
        password: password.value,
        password_confirmation: password_confirmation.value,
        type: "1",
      };
      console.log(registerData);
      let result = await Api.post("/register", registerData);
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
      name,
      email,
      bio,
      password,
      password_confirmation,
      startRegister,
    };
  },
};
</script>
<style lang="css" scoped>
.all {
  display: flex;
  flex-direction: column;
  align-items: space-between;
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