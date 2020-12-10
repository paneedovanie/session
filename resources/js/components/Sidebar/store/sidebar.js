const state = () => ({
	sidebar: {
		show: true
	}
})

const getters = {
	sidebar: state => state.sidebar
}

const mutations = {
	'SET_SIDEBAR' (state, payload) {
		state.sidebar = { ...state.sidebar, ...payload }
	},
	'SHOW_SIDEBAR' (state) {
		state.sidebar.show = true
	},

	'HIDE_SIDEBAR' (state) {
		state.sidebar.show = false
	},

	'TOGGLE_SIDEBAR' (state) {
		state.sidebar.show = !state.sidebar.show
	},
}

const actions = {
	set: ({ commit }, payload) => {
		commit('SET_SIDEBAR', payload)
	},

	show: ({ commit }) => {
		commit('SHOW_SIDEBAR')
	},

	hide: ({ commit }) => {
		commit('HIDE_SIDEBAR')
	},

	toggle: ({ commit }) => {
		commit('TOGGLE_SIDEBAR')
	},
}

export default {
	namespaced: true,
	state,
	getters,
	mutations,
	actions
}
  