export default {
	path: '/posts',
	component: () => import('../../../components/Containers/Module'),
	redirect: { name: 'posts.index' },
	children: [
		{
			path: '',
			name: 'posts.index',
			component: () => import('../Index')
		},
		{
			path: 'create',
			name: 'posts.create',
			component: () => import('../Create')
		},
	]
}