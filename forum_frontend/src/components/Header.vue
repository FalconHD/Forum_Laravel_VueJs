<template lang="">


<div v-if="store.state.logged">
  <nav class="colorMe" v-if="store.state.User.type">
        <div class="nav-wrapper container">
        <a href="#" class="brand-logo">Forum</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="profil"><i class="material-icons red-text">person_pin</i>{{store.state.User.name}}</li>
            <li v-if="store.state.User.name"><router-link to="/login"><i class="material-icons red-text" @click="logout()">exit_to_app</i></router-link></li>
        </ul>
        </div>
    </nav>
     <nav class="colorMe" v-else-if="store.state.User.type == 0">
        <div class="nav-wrapper container">
        <a href="#" class="brand-logo">Forum</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><router-link to="/">DASHBOARD</router-link></li>
            <li><router-link to="/users">USERS</router-link></li>
            <li class="profil"><i class="material-icons red-text">stars</i>{{store.state.User.name}}</li>
            <li v-if="store.state.User.name"><router-link to="/login"><i class="material-icons red-text" @click="logout()">exit_to_app</i></router-link></li>
        </ul>
        </div>
    </nav>
</div>
    
</template>
<script>
import { useStore } from "vuex";

export default {
  setup() {
    const store = useStore();
    const logout = () => {
      localStorage.removeItem("Token");
      localStorage.removeItem("user_id");
      store.state.User = {};
    };

    return {
      store,
      logout,
    };
  },
};
</script>
<style lang="css" scoped>
.colorMe {
  background-color: #282447;
}

.profil {
  display: flex;
  gap: 5px;
  text-transform: uppercase;
}
</style>