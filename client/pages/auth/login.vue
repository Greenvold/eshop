<template>
  <v-container>
    <v-row class="justify-center">
      <v-col cols="12" xl="8" lg="6" md="8">
        <card :title="$t('log_in_page')">
          <v-card-text>
            <v-row class="justify-center">
              <v-col cols="12" lg="8" md="6">
                <form
                  class="mt-5"
                  @submit.prevent="login"
                  @keydown="form.onKeydown($event)"
                >
                  <v-text-field
                    label="Email"
                    :placeholder="$t('log_in_page_email')"
                    outlined
                    v-model="form.email"
                    :error-messages="form.errors.errors.email"
                  ></v-text-field>
                  <v-text-field
                    label="Heslo"
                    :placeholder="$t('log_in_page_pwd')"
                    outlined
                    type="password"
                    v-model="form.password"
                    :error-messages="form.errors.errors.email"
                  ></v-text-field>
                  <v-btn
                    :loading="loading"
                    type="submit"
                    block
                    large
                    depressed
                    color="primary"
                    >{{ $t("log_in_page_log_in_button") }}</v-btn
                  >
                  <div class="d-flex justify-center mt-5">
                    <nuxt-link
                      :to="{ name: 'password.request' }"
                      class="small fake-link primary--text"
                    >
                      {{ $t("forgot_password") }}
                    </nuxt-link>
                  </div>
                </form>
              </v-col>
            </v-row>
          </v-card-text>
        </card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Form from "vform";

export default {
  head() {
    return {
      title: `Prihlásenie`,
    };
  },
  data: () => ({
    form: new Form({
      email: "",
      password: "",
    }),
    loading: false,
    remember: false,
  }),

  methods: {
    async login() {
      // Submit the form.
      this.loading = true;
      let data;
      // Submit the form.
      try {
        const response = await this.form.post("/login");
        data = response.data;
      } catch (e) {
        this.loading = false;
        return;
      }

      // Save the token.
      this.$store.dispatch("auth/saveToken", {
        token: data.token,
        remember: this.remember,
      });

      // Fetch the user.
      await this.$store.dispatch("auth/fetchUser");
      this.loading = false;
      // Redirect home.

      this.$router.push({ name: "home" });
    },
  },
};
</script>
