<template lang="">
    <div>
        <div class="row answer">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col s10">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea :id="id" v-model="content" class="materialize-textarea"></textarea>
                        <label :for="id">add you're answer now ...</label>
                    </div>
                </div>
            </form>
            <button class="btn waves-effect waves-light purple darken-4" type="submit" name="action" @click="addAnswer(id)">reply
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
</template>
<script>
import Api from "@/hooks/Api.js";
import { ref, watch } from "vue";
export default {
  props: {
    id: Number,
    getAnswers: Function,
  },
  setup(props) {
    const content = ref("");
    const addAnswer = async (id) => {
      let token = localStorage.getItem("Token");
      let user_id = localStorage.getItem("user_id");
      let answer = {
        Post_id: id,
        user_id: user_id,
        answer: content.value,
      };
      let result = await Api.post(`/answers/create`, answer, token);
      content.value = ''
      props.getAnswers();
      console.log(result);
    };
    watch(content, () => {
      console.log(content.value);
    });
    return {
      addAnswer,
      content,
    };
  },
};
</script>
<style lang="css" scoped>
.answer {
  display: flex;
  justify-content: space-around;
  align-items: center;
}
</style>