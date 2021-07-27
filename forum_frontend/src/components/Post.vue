<template lang="">
    <div class="col s12 m7 post" :id="post.post_id">
      <div v-if="store.state.User.type == 0 || store.state.User.id == post.user_id" @click="removePost(post.post_id)" class="remove">
        <i class="material-icons red-text">cancel</i>
      </div>
      
        <div class="card horizontal">
        <div class="card-image">
            <img :src="post.image">
            <small>{{post.name}}</small>
        </div>
        <div class="card-stacked">
            <div class="card-content">
                <h6>{{post.title}}</h6>
                <p>{{post.body}}</p>
            </div>
            <div class="card-action">
                <ul class="collapsible">
                    <li>
                      <div class="collapsible-header ">
                        <span>
                          <i class="material-icons">
                            question_answer
                          </i>
                            Answers
                        </span>
                          <span class="length">{{answers.length}}</span>
                      </div>
                      <div class="collapsible-body">
                        <span v-for="answer in answers" :key="answer.id" >
                        <Answer :answer="answer" :getAnswers="getAnswers" />
                        </span>
                        <AddAnswer :id="post.post_id" :getAnswers="getAnswers"/>
                      </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</template>
<script>
import M from "materialize-css";
import Api from "@/hooks/Api.js";
import Answer from "@/components/Answer.vue";
import AddAnswer from "@/components/AddAnswer.vue";
import { useStore } from "vuex";

import { onMounted, ref } from "vue";
export default {
  props: {
    post: Object,
    getPosts:Function
  },
  mounted() {
    M.AutoInit();
  },
  components: {
    Answer,
    AddAnswer,
  },
  setup(props) {
    const store = useStore();
    const answers = ref([]);
    const getAnswers = async () => {
      let token = localStorage.getItem("Token");
      let result = await Api.get(`/answers/${props.post.post_id}`, token);
      answers.value = result;
      console.log(answers.value);
    };
    const removePost = async (id) => {
      console.log(id);
      let token = localStorage.getItem("Token");
      await Api.delete(`/post/${id}`, token);
      props.getPosts()
    };

    onMounted(() => {
      getAnswers();
    });

    return {
      Answer,
      answers,
      getAnswers,
      removePost,
      store,
    };
  },
};
</script>
<style lang="css" scoped>
.remove {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}
.remove i {
  transition: all 0.2s ease;
}
.remove i:hover {
  cursor: pointer;
  transform: scale(1.1);
}
.card,
.collapsible-header {
  color: white;
  background-color: #282447;
}
.post {
  margin-top: 20px;
}
.card-image img {
  border-radius: 50px;
}
.card.horizontal .card-image {
  width: 10%;
  height: 100%;

  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 20px;
}
.card.horizontal .card-image img {
  width: 100%;
}
.collapsible {
  box-shadow: none;
}

small {
  color: #ffab40;
  transition: color 0.3s ease;
  text-transform: uppercase;
  text-align: center;
  margin-top: 40%;
  font-weight: bolder;
}
.collapsible-header {
  width: 100%;
  justify-content: space-between;
  align-items: center;
}
.length {
  background-color: tomato;
  padding: 3px 9px;
  border: 1px solid tomato;
  border-radius: 50px;
  margin-left: 10px;
}
.card.horizontal .card-image img {
  border-radius: 100px;
  min-width: 30px;
}
</style>