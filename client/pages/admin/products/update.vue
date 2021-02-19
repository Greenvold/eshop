<template>
  <v-container>
    <v-card>
      <v-card-title>
        Update produkt
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
          <v-select
            v-model="form.categories"
            :items="categories"
            :menu-props="{ maxHeight: '400' }"
            label="Select"
            multiple
            hint="Pick categories"
            persistent-hint
            outlined
          ></v-select>
        </v-form>
      </v-card-text>
      <v-card-actions class="d-flex justify-center">
        <v-btn color="success" @click="submit" :loading="loading">Update</v-btn>
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
      categories: "",
    };
  },
  methods: {
    fetchCategories() {
      this.$http.get("/categories").then(({ data }) => {
        this.categories = data.data;
      });
    },
    fetchProduct() {
      this.$http
        .get(`/product/${this.$route.params.product}`)
        .then(({ data }) => {
          this.form.name = data.data.name;
          this.form.description = data.data.description;
          this.form.categories = data.data.categories.map((c) => ({
            value: c.id,
            text: c.name,
          }));
        });
    },
    submit() {
      if (!this.$refs.form.validate()) return;
      this.loading = true;
      this.form
        .put(`/product/${this.$route.params.product}`)
        .then(({ data }) => {
          this.$noty.success("Product updated");
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
  mounted() {
    this.fetchCategories();
    this.fetchProduct();
  },
};
</script>

<style lang="scss" scoped></style>
