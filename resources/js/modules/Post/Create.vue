<template>
  <section>
    <h1>Create</h1>
    <v-card>
      <v-card-text>
        <v-form @submit.prevent="submit">
          <v-col cols="12">
            <v-textarea
              label="What's in your mind"
              outlined
              dense
              v-model="resource.data.body"
            ></v-textarea>
          </v-col>
          <v-col cols="12">
            <v-btn type="submit">Submit</v-btn>
          </v-col>
        </v-form>
      </v-card-text>
    </v-card>
  </section>
</template>

<script>
import auth from '../../core/auth'
import api from './routes/api'
import Post from './models/Post'

export default {
  data: () => ({
    resource: new Post,
  }),

  methods: {
    load (val = true) {
      this.resources.loading = val  
    },

    submit () {
      axios.post(api.store(), this.resource.data)
        .then(response => {
          console.log(response)
        })
    }
  },

  mounted () {
    // this.queryChanged()
    this.resource.data.user_id = auth.getUser().id
  }
}
</script>