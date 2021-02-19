<template>
  <v-container class="mt-5" fluid>
    <v-row>
      <v-col cols="12" md="3">
        <card :title="$t('settings')" class="settings-card">
          <v-list>
            <v-list-item-group color="primary" v-model="item">
              <v-list-item
                v-for="tab in tabs"
                :key="tab.route"
                active-class="active"
                :to="{ name: tab.route }"
                link
              >
                <v-list-item-icon>
                  <v-icon>{{ tab.icon }}</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title v-text="tab.name"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </card>
      </v-col>
      <v-col cols="12" md="9">
        <transition name="fade" mode="out-in">
          <router-view />
        </transition>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  middleware: "auth",
  data() {
    return {
      item: 0,
    };
  },
  computed: {
    tabs() {
      return [
        {
          icon: "mdi-account",
          name: this.$t("profile"),
          route: "settings.profile",
        },
        {
          icon: "mdi-lock",
          name: this.$t("password"),
          route: "settings.password",
        },
      ];
    },
  },
};
</script>
