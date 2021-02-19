<template>
  <v-container>
    <v-card>
      <v-card-title>
        New produkt
      </v-card-title>
      <v-card-text>
        <v-form ref="form">
          <v-text-field
            label="Nazov"
            placeholder="Vlozte nazov"
            outlined
            v-model="form.name"
            :error-messages="form.errors.errors.name"
          ></v-text-field>
          <v-textarea
            v-model="form.description"
            :auto-grow="true"
            :clearable="true"
            :label="$t('about_you')"
            :outlined="true"
            :hint="$t('tell_us_about_you')"
            :rules="[$rules.required]"
          ></v-textarea>
        </v-form>
      </v-card-text>
      <v-card-actions class="d-flex justify-center">
        <v-btn color="success" @click="submit" :loading="loading"
          >Vytvorit</v-btn
        >
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
import Form from "vform";

export default {
  middleware: "auth",
  data() {
    return {
      form: new Form({
        name: "",
        description: "",
        categories: "",
      }),
      loading: false,
    };
  },
  methods: {
    submit() {
      if (!this.$refs.form.validate()) return;
      this.loading = true;
      this.form
        .post("/product")
        .then(({ data }) => {
          console.log(data);
          this.$noty.success("Product created");
        })
        .catch(() => {
          this.$noty.error("Opps error happened");
        })
        .finally(() => {
          this.$refs.form.reset();
          this.loading = false;
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>
