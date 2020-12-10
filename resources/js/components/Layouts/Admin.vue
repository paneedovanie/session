<template>
	<v-app>
		<sidebar />

		<v-app-bar
			app
			dark
    >
      <v-app-bar-nav-icon @click="toggleSidebar"></v-app-bar-nav-icon>
			
			<v-toolbar-title>Page title</v-toolbar-title>
    </v-app-bar>

		<!-- Sizes your content based upon application components -->
		<v-main>

			<!-- Provides the application the proper gutter -->
			<v-container>

				<!-- If using vue-router -->
				<router-view></router-view>
			</v-container>
		</v-main>

		<!-- <v-footer app>
			
		</v-footer> -->
	</v-app>
</template>

<script>
import { mapActions } from 'vuex'
export default {
	methods: {
		...mapActions({
			toggleSidebar: 'sidebar/toggle',
		})
	}
}
</script>