<template>
  <v-navigation-drawer v-model="sidebar.show" app>
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>
          Application
        </v-list-item-title>
        <v-list-item-subtitle>
          subtext
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>

    <v-divider></v-divider>

    <v-list nav color="transparent" >
      <template v-for="item in items" >
        <!-- # With Children -->
        <v-list-group
          v-if="item.children"
          :key="item.title"
          :value="active(item.name)"
          :prepend-icon="item.icon"
          class="text-no-decoration"
          color="dark"
        >
          <template v-slot:activator>
            <v-list-item-title v-text="item.title"></v-list-item-title>
          </template>

          <v-list-item
            v-for="subitem in item.children"
            :key="subitem.title"
            link
            class="pl-10 text-no-decoration"
            :to="{ name: subitem.name }"
          >
            <v-list-item-icon v-if="subitem.icon">
              <v-icon v-text="subitem.icon"></v-icon>
            </v-list-item-icon>

            <v-list-item-title v-text="subitem.title"></v-list-item-title>
          </v-list-item>
        </v-list-group>
        <!-- # With Children -->

        <!-- # Without Children -->
        <v-list-item
          v-else
          :key="item.title"
          :to="{ name: item.name }"
          class="text-no-decoration"
          color="dark"
        >
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <!-- # Without Children -->
      </template>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import includes from 'lodash/includes'
import { mapGetters } from 'vuex'
import config from './config/sidebar'
export default {
  computed: {
    ...mapGetters({
      sidebar: 'sidebar/sidebar',
    }),

    items () {
      return config
    },
  },

  methods: {
    active (name) {
      return name === this.$route.name.split('.')[0]
    }
  }
}
</script>