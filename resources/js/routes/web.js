import Auth from '../core/auth'
const requireRoute = require.context(
	// The relative path of the components folder
	'../modules/',
	// Whether or not to look in subfolders
	true,
	// The regular expression used to match base component filenames
	/web.js$/
)

let routes = []
requireRoute.keys().forEach(fileName => {
	const module = require('../modules' + fileName.replace('.', '')).default
	routes.push(module)
});

export default {
	path: '/',
	component: () => import('../components/Layouts/Web'),
	children: routes,
  beforeEnter (to, from, next) {
		if(Auth.isAuthenticated()) {
			Auth.setToken(localStorage.getItem('token'))
			window.location.href = 'admin'
		}
		else next()
  },
}