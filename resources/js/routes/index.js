import VueRouter from '../plugins/vue-router' 
import a from './admin'
import w from './web'

const routes = [
	a,
  w
]

export default new VueRouter({
	mode: 'history',
	routes // short for `routes: routes`
})

 