<template>
  <v-container>
    <v-row class="justify-center">
      <v-col cols="12" xl="8" lg="6" md="8" class="m-auto">
        <card v-if="mustVerifyEmail" :title="$t('register')">
          <v-card-text class="mt-5">
            {{ $t("verify_email_address") }}
          </v-card-text>
        </card>
        <card v-else :title="$t('register')">
          <v-card-text>
            <v-row class="justify-center">
              <v-col cols="12" lg="8" md="6">
                <v-form
                  @submit.prevent="register"
                  @keydown="form.onKeydown($event)"
                  ref="form"
                >
                  <!-- Name -->
                  <v-text-field
                    name="name"
                    :label="$t('reg_page_name')"
                    id="id"
                    v-model="form.name"
                    :placeholder="$t('reg_page_insert_name')"
                    :error-messages="form.errors.errors.name"
                    outlined
                    :rules="[$rules.required, $rules.min10chars]"
                  ></v-text-field>

                  <!-- Email -->

                  <v-text-field
                    name="email"
                    :label="$t('email')"
                    :placeholder="$t('reg_page_insert_email')"
                    id="email"
                    v-model="form.email"
                    :error-messages="form.errors.errors.email"
                    outlined
                    :rules="[$rules.required, $rules.email]"
                  ></v-text-field>

                  <!-- Password -->

                  <v-text-field
                    name="password"
                    type="password"
                    :label="$t('password')"
                    :placeholder="$t('reg_page_insert_pwd')"
                    id="password"
                    v-model="form.password"
                    :error-messages="form.errors.errors.password"
                    outlined
                    :rules="[$rules.required, $rules.min10chars]"
                  ></v-text-field>

                  <!-- Password Confirmation -->

                  <v-text-field
                    name="password_confirmation"
                    :placeholder="$t('reg_page_pwd_again')"
                    type="password"
                    :label="$t('confirm_password')"
                    id="password"
                    v-model="form.password_confirmation"
                    :error-messages="form.errors.errors.password"
                    outlined
                    :rules="[$rules.required, $rules.min10chars]"
                  ></v-text-field>

                  <v-row>
                    <v-col cols="12" lg="12" class="d-flex justify-center">
                      <!-- Submit Button -->
                      <v-btn
                        color="primary"
                        type="submit"
                        :loading="form.busy"
                        >{{ $t("register") }}</v-btn
                      >
                    </v-col>
                  </v-row>
                </v-form>
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
  middleware: "guest",
  head() {
    return {
      title: `Registrácia`,
    };
  },
  data: () => ({
    form: new Form({
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    }),
    mustVerifyEmail: false,
  }),

  methods: {
    async register() {
      // Register the user.

      if (this.form.name.length < 2) {
        this.$noty.warning("Meno musi mat aspon 8 znakov.");
        return;
      }
      if (!this.$refs.form.validate()) return;
      let data;
      // Register the user.
      try {
        const response = await this.form.post("/register");
        data = response.data;
      } catch (e) {
        return;
      }
      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true;
      } else {
        // Log in the user.
        const {
          data: { token },
        } = await this.form.post("/login");

        // Save the token.
        this.$store.dispatch("auth/saveToken", { token });

        // Update the user.
        // await this.$store.dispatch("auth/updateUser", { user: data });

        await this.$store.dispatch("auth/fetchUser");
        // Redirect home.
        this.$router.push({ name: "home" });
      }
    },
  },
};
</script>
