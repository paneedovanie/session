<template>
	<div>
		<v-list-item class="pl-0" three-line>
			<v-list-item-content>
				<v-list-item-title class="white--text headline mb-1">
					Access the services
				</v-list-item-title>
				<v-list-item-subtitle class="grey--text text--lighten-1">You may now use the services by logging in.</v-list-item-subtitle>
			</v-list-item-content>
		</v-list-item>
		<v-form @submit.prevent="submit" :disabled="isLoading">
			<v-row>
				<v-col cols="12">
					<v-text-field
						:error-messages="resource.errors.email"
						label="E-mail"
						outlined
						v-model="resource.data.email"
						prepend-inner-icon="mdi-email"
						dense
						dark
					>
					</v-text-field>
				</v-col>
				<v-col cols="12">
					<v-text-field
						:error-messages="resource.errors.password"
						label="Password"
						outlined
						type="password"
						v-model="resource.data.password"
						prepend-inner-icon="mdi-key"
						dense
						dark
					>
					</v-text-field>
				</v-col>
				<v-col cols="12">
					<v-btn color="orange" type="submit" :loading="isLoading" :disabled="isLoading" width="100%">Submit</v-btn>
				</v-col>
			</v-row>
		</v-form>
	</div>
</template>

<script>
import Auth from '../../../core/auth'
import User from '../models/User'
import api from '../routes/api'
import { mapActions } from 'vuex'

export default {
	computed: {
		isLoading () { return this.resource.loading }
	},

	data: () =>({
		resource: new User
	}),

	methods: {
		load (val = true) {
			this.resource.loading = val
		},

		submit () {
			this.load()
			this.resource.errors = {}

			axios.post(api.login(), this.resource.data)
				.then(response => {
          const { token, user } = response.data.data
          console.log(token, user)
          Auth.set(token, user)
          this.$router.push({ name: 'dashboard' })
				})
				.catch(err => {
					this.resource.errors = { ...this.resource.errors, ...err.response.data.errors }
				})
				.finally(() => {
					this.load(false)
				})
		}
	},

	mounted() {
		this.load(false)
	}
}
</script>