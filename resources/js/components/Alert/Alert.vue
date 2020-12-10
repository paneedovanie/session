<template>
  <v-alert
			v-model="alert.show"
      :icon="alert.icon"
      :type="alert.type"
      text
    >
			<p v-text="alert.content.message"></p>
			<ul>
				<li v-for="(item, i) in alert.content.errors" :key="i">
					<span v-for="(subitem, j) in item" :key="j" v-text="(j === 0 ? '' : ', ') + subitem"></span>
				</li>
			</ul>
    </v-alert>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters({
      alert: 'alert/alert',
    }),
  },
}
</script>