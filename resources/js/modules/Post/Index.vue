<template>
  <section>
    <h1>Posts <v-btn outlined>Add</v-btn></h1>
    <v-card>
      <v-card-text>
        <v-text-field
          placeholder="Search"
          outlined
          dense
          @input="search"
          v-model="resources.search"
        ></v-text-field>
      </v-card-text>
      <v-data-table
        :headers="resources.headers"
        color="primary"
        item-key="id"
        :options.sync="options"
        @update:options="optionsChanged"
        :server-items-length="resources.meta.total"
        :items="resources.data"
        v-model="resources.selected"
        >
      </v-data-table>
    </v-card>
  </section>
</template>

<script>
import api from './routes/api'
export default {
  data: () => ({
    options: {},
    resources: {
      loading: false,
      headers: [
        { text: 'Content', align: 'left', value: 'body', class: 'text-no-wrap' },
        { text: 'Author', align: 'left', value: 'author', class: 'text-no-wrap' },
        { text: 'Created', align: 'left', value: 'created_at', class: 'text-no-wrap' },
      ],
      search: null,
      options: {
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        sortDesc: [],
        sortBy: [],
      },
      data: [],
      meta: {}
    },
  }),

  methods: {
    getResources (params) {
      axios.get(api.list(), { params })
      .then(response => {
        console.log(response)
        const { data, total } = response.data
        this.resources.data = data
        this.resources.meta.total = total
      })
      .catch( err => console.log(err) )
      .finally(() => this.load(false))
    },

    load (val = true) {
      this.resources.loading = val  
    },

    optionsChanged (options) {
      let query = { per_page: options.itemsPerPage, page: options.page } 
      if(this.resources.search) query = { ...query, search: this.resources.search }
      this.$router.push({ query }).catch(err => {})
      this.getResources(query)
    },

    queryChanged () {
      this.options = {
        itemsPerPage: parseInt(this.$route.query.per_page),
        page: this.$route.query.page
      } 
    },

    search (val) {
      this.optionsChanged(this.resources.options)
    }
  },

  mounted () {
    this.queryChanged()
  }
}
</script>