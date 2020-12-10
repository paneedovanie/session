<template>
	<v-app class="web">
		<!-- <v-app-bar
			app
      color="transparent"
			elevation="0"
    >
			<v-container class="d-flex align-center">
        <v-toolbar-title>Page title</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn text to="login" link v-text="`Login`"></v-btn>
			</v-container>
    </v-app-bar> -->

		<!-- Sizes your content based upon application components -->
		<v-main>

			<!-- Provides the application the proper gutter -->
			<v-container fluid>

				<!-- If using vue-router -->
				<router-view></router-view>
			</v-container>
		</v-main>
	</v-app>
</template>

<script>
export default {
	
}
</script>

<style scoped>
.web {
	background-image: url('../../assets/images/main/bg.jpg');
	background-size: cover;
	height: 100vh;
}
.container {
	height: 100%;
}
</style>