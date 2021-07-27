<template lang="">
<div class="col s12 m7 add">
    <h4 class="header">Add New Post</h4>
    <div class="card horizontal">
      <div class="card-stacked">
        <div class="card-content">
            <div class="row">
                <div class="input-field col s12">
                <input v-model="title" id="QUESTION" type="text">
                <label  for="QUESTION">YOUR QUESTION ?</label>
                </div>
            </div>
          <textarea v-model="body" id="postbody" placeholder="Describe your problem ........."/>
        </div>
        <div class="card-action">
            <a @click="addPost" class="btn-floating btn-large waves-effect waves-light red"><i  class="material-icons">add</i></a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { ref } from "vue";
import Api from "@/hooks/Api.js";
export default {
  props: {
    getPosts: Function,
  },
  setup(props) {
    const title = ref("");
    const body = ref("");

    const addPost = async () => {
      let token = localStorage.getItem("Token");
      let post = {
        user_id: localStorage.getItem("user_id"),
        title: title.value,
        body: body.value,
      };
      let result = await Api.post(`/create`, post, token);
      title.value = "";
      body.value = "";
      props.getPosts();
      console.log(result);
    };

    return {
      body,
      title,
      addPost,
    };
  },
};
</script>
<style lang="css" scoped>
.add {
  background: #282447;
  color: white;
}

.card-action {
  display: flex;
  justify-content: flex-end;
}
.card .card-content {
  padding: 0 20px;
  background-color: #bbbdbf15;
}
.header {
  padding: 10px;
  width: 100%;
  text-align: center;
}

.card .card-content textarea {
  padding: 2px;
  border: none;
  height: 50px;
  transition: all 0.2s ease;
}
.card .card-content textarea:focus-visible {
  outline: none;
  height: 150px;
}
</style>