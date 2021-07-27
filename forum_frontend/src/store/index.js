import { createStore } from 'vuex'

export default createStore({
  state: {
    logged : false,
    type : "",
    User : {},
    deleting :{
      target:"",
      id:null,
      accepte:false
    },
    updating :{
      target:"",
      id:null,
      accepte:false,
      type:""
    }
  },
  getters: {
    delete(state) {
      return state.deleting
    },
    update(state) {
      return state.deleting
    }
  },
  mutations: {
  },
  actions: {
  },
  modules: {
  }
})
