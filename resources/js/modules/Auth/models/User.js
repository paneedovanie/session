class User {
	constructor () {
		this.errors = {}
		this.loading = true
		this.prestine = true
	
		this.data = {
			firstname: '',
			lastname: '',
			email: '',
			username: '',
			password: '',
			type: 'user'
		}
	}
}

export default User