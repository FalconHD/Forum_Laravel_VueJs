<template>
  <div>
    <Header />
    <div class="container">
      <router-view />
    </div>
    <div id="modal1" class="modal">
      <div class="modal-content">
        <div v-if="store.state.deleting.id">
          <h6 class="red-text">Are you shoore you want to delete</h6>
          <p>click agree to continue</p>
        </div>
        <div v-else-if="store.state.updating.id">
          <h6>change type for this user</h6>
          <span>
            {{
              store.state.updating.currtype
                ? "change this User to normal Admin"
                : "change this Admin to User"
            }}
          </span>
        </div>
      </div>
      <div class="modal-footer">
        <a
          @click="
            store.state.deleting.id
              ? startDelelting(store.state.deleting.id)
              : startUpdating(
                  store.state.updating.id,
                  store.state.updating.currtype ? 0 : 1
                )
          "
          class="modal-close waves-effect waves-green btn-flat"
          >continue</a
        >
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted } from "vue";
import { useRouter } from "vue-router";
import M from "materialize-css";
import Header from "@/components/Header.vue";
import { useStore } from "vuex";
import Api from "@/hooks/Api.js";

export default {
  setup() {
    const store = useStore();
    const route = useRouter();
    let token = localStorage.getItem("Token");
    const getUser = async () => {
      let result = await Api.get(
        `/userinfo/${localStorage.getItem("user_id")}`,
        token
      );
      store.state.User = result;
      store.state.logged = true;
    };

    onMounted(() => {
      M.AutoInit();
      if (!store.state.logged && token) {
        getUser();
      } else {
        route.push("/Login");
      }
    });

    const startDelelting = async (id) => {
      store.state.updating = {
        target: "",
        id: null,
        accepte: true,
      };
      let token = localStorage.getItem("Token");
      let result = await Api.get(`/delete/${id}`, token);
      console.log(result);
      store.state.deleting = {
        target: "",
        id: null,
        accepte: true,
      };
    };

    const startUpdating = async (id, type) => {
      store.state.deleting = {
        target: "",
        id: null,
        accepte: true,
      };
      let data = {
        type,
      };
      let token = localStorage.getItem("Token");
      let result = await Api.put(`/user/${id}`, data, token);
      console.log(result);
      store.state.updating = {
        target: "",
        id: null,
        accepte: true,
      };
      console.log("started", id);
    };

    return {
      store,
      startDelelting,
      startUpdating,
    };
  },
  components: {
    Header,
  },
};
</script>

<style>
body {
  background-color: #2c2f33;
}
</style>
