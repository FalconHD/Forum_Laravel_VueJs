<template>
  <div>
    <div><Add :getPosts="getPosts"/></div>
    <div class="posts" v-for="post in posts" :key="post.post_id">
      <Post :post="post" class="black" :getPosts="getPosts" />
    </div>
  </div>
</template>

<script>
import Api from "@/hooks/Api.js";
import Post from "@/components/Post.vue";
import Add from "@/components/AddPost.vue";
import { ref, onMounted } from "vue";
export default {
  name: "Main",
  components: {
    Post,
    Add,
  },
  setup() {

    const posts = ref([]);
    const getPosts = async () => {
      let Token = localStorage.getItem("Token");
      let result = await Api.get("/", Token);
      posts.value = result;
      console.log(posts.value);
    };
    onMounted(() => {
      console.log(process.env.VUE_APP_BACKEND_URL);
      getPosts();
    });

    return {
      posts,
      Add,
      getPosts
    };
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
