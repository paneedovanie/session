const state = () => ({
	alert: {
		show: false,
		type: 'error',
		icon: 'mdi-alert',
		content: ''
	}
})

const getters = {
	alert: state => state.alert
}

const mutations = {
	'SET_ALERT' (state, payload) {
		state.alert = { ...state.alert, ...payload }
	},
	'SHOW_ALERT' (state) {
		state.alert.show = true
	},

	'HIDE_ALERT' (state) {
		state.alert.show = false
	},
}

const actions = {
	set: ({ commit }, payload) => {
		commit('SET_ALERT', payload)
	},

	show: ({ commit }) => {
		commit('SHOW_ALERT')
	},

	hide: ({ commit }) => {
		commit('HIDE_ALERT')
	},
}

export default {
	namespaced: true,
	state,
	getters,
	mutations,
	actions
}
  