<template>
  <v-container>
    <v-card>
      <v-card-title>
        {{ $t("home") }}
      </v-card-title>
      <v-card-text>
        {{ $t("you_are_logged_in") }}
        <p class="mt-5">
          Please use the navigation bar to access admin section
        </p>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
export default {
  middleware: "auth",

  head() {
    return { title: this.$t("home") };
  },
};
</script>
