export default new class Auth {
  constructor () {
    this.token = localStorage.getItem('token') || null
    this.user = localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null
  }

  set ( token, user ) {
    localStorage.setItem('token', token)
    localStorage.setItem('user', JSON.stringify(user))
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

    this.token = token
    this.user = user
  }

  getUser () {
    return this.user
  }

  setToken (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
  }

  remove () {
    localStorage.removeItem('token')
    localStorage.removeItem('user')
    this.token = null
    this.user = null
  }

  isAuthenticated () {
    return this.token && this.user ? true : false
  }
} 