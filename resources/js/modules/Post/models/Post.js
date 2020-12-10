class Post {
	constructor () {
		this.errors = {}
		this.loading = true
		this.prestine = true
	
		this.data = {
			body: null,
			user_id: null
		}
	}
}

export default Post