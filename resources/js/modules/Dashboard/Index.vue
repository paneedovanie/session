<template>
	<div>
		<h1>Dashboard</h1>
		<p v-text="getDuration(currentSession.created_at, currentSession.updated_at)"></p>
		<table border="1">
			<thead>
				<tr>
					<th>Sessions</th>
					<th>Durations</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(session,i) in sessions" :key="i">
					<td v-text="session.created_at"></td>
					<td v-text="getDuration(session.created_at,session.updated_at)"></td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
import api from './routes/api'
import auth from '../../core/auth'
export default {
	data: () => ({
		currentSession: {},
		sessions: []
	}),

	methods: {
		getSessions () {
			axios.get(api.list(), {
				params: {
					user_id: auth.getUser().id,
					lesson_id: 1
				}
			})
			.then(response => {
				this.sessions = response.data.data
			})
			.catch(err => {
				console.log(err)
			})
		},

		updateSession () {
			axios.post(api.log(), {
				user_id: auth.getUser().id,
				lesson_id: 1
			})
			.then(response => {
				this.currentSession = response.data.data
			})
			.catch(err => {
				console.log(err)
			})
		},

    getDuration (started, finished) {
      const startedDate = new Date(started).getTime()
      const finishedDate = new Date(finished).getTime()
      let duration = finishedDate - startedDate

      let result = ''

      const timebase = { 
				week: 1000 * 60 * 60 * 24 * 7,
				day: 1000 * 60 * 60 * 24,
				hour: 1000 * 60 * 60,
				minute: 1000 * 60,
				second: 1000
      }

      Object.keys(timebase).forEach(e => {
        const calculated = parseInt(duration / timebase[e])
        if(calculated > 0) {
          result += `${calculated} ${e}${calculated > 1 ? 's' : ''} `
          duration -= timebase[e] * calculated
        }
      })

      return result === '' ? 'less than a second' : result
    },
	},

	mounted () {
		this.getSessions()
		let timer = setInterval(() => {
			this.updateSession()
		}, 1000)
	}
}
</script>