<template>
  <card :title="$t('your_info')">
    <v-card-text>
      <form ref="form" class="mt-5">
        <!-- <alert-success :form="form" :message="$t('info_updated')" /> -->
        <!-- Name -->
        <v-row class="justify-center">
          <v-col xs="12" sm="12" md="7" cols="12">
            <v-text-field
              :label="$t('name')"
              outlined
              v-model="form.name"
              :rules="[$rules.required, $rules.min10chars]"
            ></v-text-field>
          </v-col>
          <v-col xs="12" sm="7" md="7" cols="12">
            <v-text-field
              :label="$t('email')"
              outlined
              v-model="form.email"
              type="email"
              :rules="[$rules.required, $rules.email]"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="12" class="d-flex justify-center">
            <v-btn color="primary" @click="update"> {{ $t("update") }}</v-btn>
          </v-col>
        </v-row>
      </form>
    </v-card-text>
  </card>
</template>

<script>
import Form from "vform";
import { mapGetters } from "vuex";

export default {
  scrollToTop: false,
  head() {
    return {
      title: `Profil`,
    };
  },

  data: () => ({
    form: new Form({
      name: "",
      email: "",
    }),
  }),

  computed: {
    ...mapGetters({
      user: "auth/user",
    }),
  },

  created() {
    // Fill the form with user data.
    this.form.keys().forEach((key) => {
      this.form[key] = this.user[key];
    });
  },

  methods: {
    async update() {
      const { data } = await this.form.patch("/settings/profile").catch(() => {
        alert("error");
      });

      this.$store.dispatch("auth/updateUser", { user: data });
      this.$noty.success("Natavenia uspesne zmenene");
    },
  },
};
</script>
<style scoped></style>
