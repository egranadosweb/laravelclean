

export default {

    state() {
        return {
            name : "Edwin"
        }
    },

    getters : {
        getName(state, getters){
            return this.state.name;
        }
    },

    mutations : {
        CHANGE_NAME({state, rootState} , name){
            this.state.name = name
        },
    },

    actions : {
        setName({commit, state, rootState} , data){
            commit("CHANGE_NAME", data)
        }
    }

}