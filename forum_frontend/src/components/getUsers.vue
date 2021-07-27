<template lang="">
    <div :key="store.state.deleting.id">
    <div class="card">
    <div class="card-content">
      <table class="centered">
        <thead>
          <tr>
              <th>IMAGE</th>
              <th>NAME</th>
              <th>EMAIL</th>
              <th>BIO</th>
              <th>JOINED IN</th>
              <th>STATUS</th>
              <th>REMOVE</th>
              <th>ACTIVITIES</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td  class="img"><img :src="user.image"/></td>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>{{user.bio}}</td>
           
            <td>{{ new Intl.DateTimeFormat('en-GB', { dateStyle: 'full', timeStyle: 'long' }).format(new Date(user.created_at))}}</td>
            <td @click="startUpdating(user.id,user.type)" class="modal-trigger" href="#modal1">{{user.type == 1 ? "USER" : "ADMIN"}}</td>
            <td><i @click="startDeleting(user.id)" class="material-icons red-text modal-trigger" href="#modal1">delete_forever</i></td>
            <td><router-link :to="{ name: 'user', params: { id: user.id }}"><i class="material-icons yellow-text">launch</i></router-link></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>    
    </div>
</template>
<script>
import { ref, onMounted, watch, computed } from "vue";
import { useStore } from "vuex";
import Api from "@/hooks/Api.js";
export default {
  setup() {
    const store = useStore();
    const users = ref([]);
    const getUsers = async () => {
      let token = localStorage.getItem("Token");
      let result = await Api.get(`/users`, token);
      users.value = result;
      console.log(users.value);
    };

    const startDeleting = async (id) => {
      store.state.updating = {
        target: "",
        id: null,
        accepte: true,
        currtype :""
      };

      store.state.deleting = {
        target: "user",
        id: id,
        accepte: false,
      };
    };

    const startUpdating = async (id,type) => {
      store.state.deleting = {
        target: "",
        id: null,
        accepte: false,
      };
      console.log(id);
      store.state.updating = {
        target: "user",
        id: id,
        accepte: false,
        currtype :type
      };
    };
    onMounted(() => {
      getUsers();
    });
    const reload = () => {
      if (storeUpdated.value.accepte) {
        getUsers();
      }
    };

    let storeUpdated = computed(() => store.getters.delete);
    watch(
      () => store.getters.delete,
      () => reload()
    );

    return {
      users,
      startDeleting,
      store,
      startUpdating,
    };
  },
};
</script>
<style lang="css" scoped>
.img {
  max-width: 70px;
}
.img img {
  width: 100%;
  border-radius: 100px;
}
.card {
  background-color: #282447;
  color: white;
  font-size: 12px;
}
</style>