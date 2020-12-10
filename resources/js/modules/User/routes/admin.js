export default {
	path: '/users',
	component: () => import('../../../components/Containers/Module'),
	redirect: { name: 'users.index' },
	children: [
		{
			path: '',
			name: 'users.index',
			component: () => import('../Index')
		},
	]
}