<template>
	<section bg="white">
		<v-row>
			<v-col cols="12" md="6" lg="9" class="d-none d-md-block">
				<animation />
			</v-col>
			<v-col cols="12" md="6" lg="3">
				<v-card color="transparent" elevation="0">
					<v-card-text class="pt-0">
						<v-tabs
							v-model="tab"
							backgroundColor="transparent"
							color="orange"
							dark
						>
							<v-tabs-slider color="orange"></v-tabs-slider>

							<v-tab
								v-for="item in tabs"
								:key="item"
							>
								{{ item }}
							</v-tab>
						</v-tabs>
						<v-tabs-items 
							v-model="tab"
							class="transparent"
						>
							<v-tab-item>
								<register v-if="!tab" />
							</v-tab-item>
							<v-tab-item>
								<login v-if="tab" />
							</v-tab-item>
						</v-tabs-items>
					</v-card-text>
				</v-card>
			</v-col>
		</v-row>
	</section>
</template>

<script>

export default {
	components: {
		Animation: () => import('./partials/Animation'),
		Login: () => import('./partials/Login'),
		Register: () => import('./partials/Register'),
	},

	data: () =>({
		tab: 'register',
		tabs: ['register', 'login']
	}),
}
</script>