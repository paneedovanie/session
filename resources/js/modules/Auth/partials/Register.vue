<template>
  <div>
    <v-list-item class="pl-0" three-line>
      <v-list-item-content>
        <v-list-item-title class="white--text headline mb-1">
          Get access
        </v-list-item-title>
        <v-list-item-subtitle class="grey--text text--lighten-1">Register to gain account to access the services.</v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    <v-form @submit.prevent="submit" :disabled="isLoading">
      <v-row>
        <v-col cols="12">
          <v-text-field
            :error-messages="resource.errors.firstname"
            color="white"
            dense
            label="First name"
            outlined
            prepend-inner-icon="mdi-account"
            v-model="resource.data.firstname"
            dark
          >
          </v-text-field>
        </v-col>
        <v-col cols="12">
          <v-text-field
            :error-messages="resource.errors.lastname"
            color="white"
            dense
            label="Last name"
            outlined
            prepend-inner-icon="mdi-account"
            v-model="resource.data.lastname"
            dark
          >
          </v-text-field>
        </v-col>
        <v-col cols="12">
          <v-text-field
            :error-messages="resource.errors.email"
            color="white"
            dense
            label="E-mail"
            outlined
            prepend-inner-icon="mdi-email"
            v-model="resource.data.email"
            dark
          >
          </v-text-field>
        </v-col>
        <v-col cols="12">
          <v-text-field
            :error-messages="resource.errors.username"
            color="white"
            dense
            label="Username"
            outlined
            prepend-inner-icon="mdi-account"
            v-model="resource.data.username"
            dark
          >
          </v-text-field>
        </v-col>
        <v-col cols="12">
          <v-text-field
            :error-messages="resource.errors.password"
            color="white"
            dense
            label="Password"
            outlined
            prepend-inner-icon="mdi-key"
            type="password"
            v-model="resource.data.password"
            dark
          >
          </v-text-field>
        </v-col>
        <v-col cols="12">
          <v-text-field
            :error-messages="resource.errors.password_confirmation"
            borderColor="white"
            color="white"
            dense
            label="Confirm Password"
            outlined
            prepend-inner-icon="mdi-key"
            type="password"
            v-model="resource.data.password_confirmation"
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
	components: {
		Login: () => import('./Login')
	},

	computed: {
		isLoading () { return this.resource.loading }
	},

	data: () =>({
		resource: new User,
	}),

	methods: {
		load (val = true) {
			this.resource.loading = val
		},

		submit () {
			this.load()
			this.resource.errors = {}

			axios.post(api.register(), this.resource.data)
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