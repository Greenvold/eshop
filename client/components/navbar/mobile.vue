<template>
  <v-list nav dense dark>
    <v-list-item link>
      <v-list-item-action>
        <v-icon>mdi-home</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>Home</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <!-- Logged in user section -->
    <template v-if="user">
      <v-list-group no-action color="white--text">
        <template v-slot:activator>
          <v-list-item-content>
            <v-list-item-title> {{ user.name }}</v-list-item-title>
          </v-list-item-content>
        </template>
        <v-list-item
          exact
          v-for="link in userLinks"
          :to="{ name: link.link }"
          :key="link.title"
          link
        >
          <v-list-item-icon>
            <v-icon v-text="link.icon"></v-icon>
          </v-list-item-icon>
          <v-list-item-title v-text="link.title"></v-list-item-title>
        </v-list-item>
        <v-list-item @click.prevent="logout">
          <v-list-item-title
            ><v-icon class="mr-3">mdi-logout</v-icon>
            {{ $t("logout") }}</v-list-item-title
          >
        </v-list-item>
      </v-list-group>
    </template>
    <!-- Login section -->

    <template v-else>
      <v-list-item exact :to="{ name: 'login' }" link>
        <v-list-item-action>
          <v-icon>mdi-login</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>{{ $t("mobile_login_button") }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item :to="{ name: 'register' }" link>
        <v-list-item-action>
          <v-icon>mdi-account-plus</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>{{ $t("register") }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </template>
    <v-list-item
      link
      exact
      :to="{ name: link.link }"
      v-for="link in generalLinks"
      :key="link.title"
    >
      <v-list-item-action>
        <v-icon>{{ link.icon }}</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>{{ link.title }}</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
  </v-list>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      generalLinks: [
        {
          title: this.$t("home"),
          icon: "mdi-home",
          link: "home",
        },
      ],
      userLinks: [
        {
          title: this.$t("nav_admin_zone"),
          icon: "mdi-database",
          link: "admin.index",
        },
        {
          title: this.$t("settings"),
          icon: "mdi-cog-outline",
          link: "settings.profile",
        },
      ],
    };
  },

  computed: {
    ...mapGetters({
      user: "auth/user",
    }),
    isMobile() {
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

<style lang="scss" scoped></style>
