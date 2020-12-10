export default {
	path: '/',
	component: () => import('../../../components/Containers/Module'),
	redirect: { name: 'dashboard' },
	children: [
		{
			path: '',
			name: 'dashboard',
			component: () => import('../Index')
		},
	]
}