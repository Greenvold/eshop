<template>
  <div class="keks">
    <v-app-bar v-if="mobile" color="primary" dark dense>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title class="mr-4">Eshop</v-toolbar-title>
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      app
      v-if="mobile"
      color="primary"
      dark
    >
      <mobile-navbar />
    </v-navigation-drawer>
    <v-app-bar color="primary" dark dense v-else>
      <nuxt-link
        :to="{ name: 'home' }"
        style="cursor: pointer;"
        tag="div"
        class="v-toolbar__title mr-4"
        >Eshop</nuxt-link
      >
      <v-spacer></v-spacer>
      <LocaleDropdown />
      <template v-if="user">
        <v-menu offset-y open-on-hover>
          <template v-slot:activator="{ on, attrs }">
            <v-btn text v-bind="attrs" v-on="on">
              {{ user.name }}
            </v-btn>
          </template>
          <v-list>
            <v-list-item
              :to="{
                name: 'admin.index',
              }"
            >
              <v-list-item-title>
                <v-icon class="mr-3">mdi-database</v-icon>
                {{ $t("nav_admin_zone") }}</v-list-item-title
              >
            </v-list-item>
            <v-list-item :to="{ name: 'settings.profile' }">
              <v-list-item-title
                ><v-icon class="mr-3">mdi-cog</v-icon>
                {{ $t("settings") }}</v-list-item-title
              >
            </v-list-item>
            <v-list-item @click.prevent="logout">
              <v-list-item-title
                ><v-icon class="mr-3">mdi-logout</v-icon>
                {{ $t("logout") }}</v-list-item-title
              >
            </v-list-item>
          </v-list>
        </v-menu>
      </template>
      <template v-else>
        <v-btn text link :to="{ name: 'login' }">
          {{ $t("nav_log_in") }}
        </v-btn>
        <v-btn text :to="{ name: 'register' }">
          {{ $t("nav_register") }}
        </v-btn>
      </template>
    </v-app-bar>
  </div>
</template>
<script>
import { mapGetters } from "vuex";

export default {
  components: {
    "mobile-navbar": require("~/components/navbar/mobile").default,
    LocaleDropdown: require("~/components/LocaleDropdown").default,
  },
  // props: ["mobile"],
  data: () => ({
    appName: "Eshop",
    drawer: null,
    searchInput: "",
    isMounted: false,
  }),

  computed: {
    ...mapGetters({
      user: "auth/user",
    }),
    mobile: function () {
      return this.$vuetify.breakpoint.mobile;
    },
  },

  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");

      // Redirect to login.
      this.$router.push({ name: "login" });
    },
  },
};
</script>

<style scoped>
.v-app-bar {
  z-index: 150;
}
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -0.375rem 0;
}

#lblCartCount {
  font-size: 12px;
  background: #ff6200;
  color: #fff;
  padding: 2px 5px;
  vertical-align: top;
  margin-left: -10px;
}

#lblNotificationCount {
  font-size: 12px;
  background: #ff6200;
  color: #fff;
  padding: 2px 5px;
  vertical-align: top;
  margin-left: -10px;
}
.badge {
  padding-left: 9px;
  padding-right: 9px;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}
.cart {
  min-width: 50px;
}
.label-warning[href],
.badge-warning[href] {
  background-color: #c67605;
}
/* *:not(.fas) {
  font-family: "Comfortaa", cursive;
} */
</style>
