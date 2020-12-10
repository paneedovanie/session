export default {
	path: '',
	component: () => import('../../../components/Containers/Module'),
	redirect: '/',
	children: [
		{
			path: '',
			name: 'home',
			component: () => import('../Index')
		},
	]
}