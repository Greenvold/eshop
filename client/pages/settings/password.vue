<template>
  <card :title="$t('your_password')">
    <v-card-text>
      <v-form
        ref="form"
        class="mt-5"
        @submit.prevent="update"
        @keydown="form.onKeydown($event)"
      >
        <v-row class="justify-center">
          <v-col xs="12" sm="12" md="8" cols="12">
            <v-text-field
              :label="$t('new_password')"
              type="password"
              outlined
              v-model="form.password"
              :rules="[$rules.required, $rules.min10chars]"
              :error-messages="form.errors.errors.password"
            ></v-text-field>
          </v-col>
          <v-col xs="12" sm="12" md="8" cols="12">
            <v-text-field
              :label="$t('confirm_password')"
              type="password"
              outlined
              v-model="form.password_confirmation"
              :rules="[$rules.required, $rules.min10chars]"
            ></v-text-field>
          </v-col>
        </v-row>
        <!-- Submit Button -->
        <v-row class="justify-center">
          <v-col xs="12" sm="12" md="8" cols="12" class="d-flex justify-center">
            <v-btn :loading="form.busy" color="primary" @click="update">
              {{ $t("update") }}</v-btn
            >
          </v-col>
        </v-row>
      </v-form>
    </v-card-text>
  </card>
</template>

<script>
import Form from "vform";

export default {
  scrollToTop: false,

  metaInfo() {
    return { title: this.$t("settings") };
  },

  data: () => ({
    form: new Form({
      password: "",
      password_confirmation: "",
    }),
  }),

  methods: {
    async update() {
      await this.form.patch("/settings/password");

      this.$refs.form.reset();
      this.$noty.success("Natavenia uspesne zmenene");
    },
  },
};
</script>
