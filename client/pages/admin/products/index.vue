<template>
  <v-container>
    <div v-if="products">
      <template>
        <v-data-table
          :headers="headers"
          :items="products"
          sort-by="calories"
          class="elevation-1"
        >
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>All products</v-toolbar-title>
              <v-divider class="mx-4" inset vertical></v-divider>
              <v-spacer></v-spacer>
              <v-btn
                color="primary"
                dark
                class="mb-2"
                :to="{ name: 'product.create' }"
              >
                New Product
              </v-btn>
            </v-toolbar>
          </template>
          <template v-slot:item.categories="{ item }">
            <v-chip
              class="ma-2"
              color="primary"
              v-for="category in item.categories"
              :key="category.id"
            >
              {{ category.name }}
            </v-chip>
          </template>
          <template v-slot:item.actions="{ item }">
            <v-btn
              color="success"
              :to="{ name: 'product.update', params: { product: item.id } }"
            >
              <v-icon small class="mr-2">
                mdi-pencil
              </v-icon>
            </v-btn>

            <v-btn color="success" @click="deleteItemConfirm(item.id)">
              <v-icon small>
                mdi-delete
              </v-icon>
            </v-btn>
          </template>
          <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">
              Reset
            </v-btn>
          </template>
        </v-data-table>
      </template>
    </div>
  </v-container>
</template>

<script>
export default {
  middleware: "auth",
  data() {
    return {
      products: null,
      headers: [
        {
          text: "Name",
          align: "start",
          sortable: false,
          value: "name",
        },
        {
          text: "Description",
          align: "start",
          sortable: false,
          value: "description",
        },
        {
          text: "Hash",
          align: "start",
          sortable: false,
          value: "unique_hash",
        },
        {
          text: "Categories",
          align: "start",
          sortable: false,
          value: "categories",
        },
        {
          text: "Actions",
          align: "start",
          sortable: false,
          value: "actions",
        },
      ],
    };
  },
  methods: {
    fetchProdcuts() {
      this.$http.get("/products").then(({ data }) => {
        this.products = data.data;
      });
    },
    deleteItemConfirm(id) {
      this.$http.delete(`/product/${id}`).then(() => {
        this.products = this.products.filter((p) => p.id != id);
        this.$noty.success("Deletion successfull!");
      });
    },
  },
  mounted() {
    this.fetchProdcuts();
  },
};
</script>

<style lang="scss" scoped></style>
