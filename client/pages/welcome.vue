<template>
  <v-container>
    <v-card>
      <v-card-title>
        This is the home page for unregistered users
      </v-card-title>
      <v-card-text>
        Please login to proceed
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  layout: "simple",

  data: () => ({
    title: process.env.appName,
  }),

  head() {
    return { title: this.$t("home") };
  },

  computed: mapGetters({
    authenticated: "auth/check",
  }),
};
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}

.laravel {
  color: #2e495e;
}

.nuxt {
  color: #00c48d;
}
</style>
