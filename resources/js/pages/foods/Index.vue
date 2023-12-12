<template>
<div>
  <v-data-table :headers="headers" :items="desserts" sort-by="calories" class="elevation-1">
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>My CRUD</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              New Item
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.name" label="Dessert name"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.iron" label="Iron (g)"></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">
                Cancel
              </v-btn>
              <v-btn color="blue darken-1" text @click="save">
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)">
        mdi-pencil
      </v-icon>
      <v-icon small @click="deleteItem(item)">
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize">
        Reset
      </v-btn>
    </template>
  </v-data-table>
  <v-snackbar v-model="snackbar" :timeout="9000" :color="snackcolor">
    {{ snacktext }}
    <v-btn color="white" text @click="snackbar = false">Close</v-btn>
  </v-snackbar>
</div>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    snackbar: false,
    snackcolor: '',
    snacktext: '',
    headers: [{
        text: 'Dessert (100g serving)',
        align: 'start',
        sortable: false,
        value: 'name',
      },
      {
        text: 'Calories',
        value: 'calories'
      },
      {
        text: 'Fat (g)',
        value: 'fat'
      },
      {
        text: 'Carbs (g)',
        value: 'carbs'
      },
      {
        text: 'Protein (g)',
        value: 'protein'
      },
      {
        text: 'Iron (g)',
        value: 'iron'
      },
      {
        text: 'Actions',
        value: 'actions',
        sortable: false
      },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
      iron: 0

    },
    defaultItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
      iron: 0
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
    },
  },

  watch: {
    dialog(val) {
      val || this.close()
    },
    dialogDelete(val) {
      val || this.closeDelete()
    },
  },

  created() {
    this.initialize()
  },
  methods: {
    initialize() {
      this.fetchApp()
    },
    async fetchApp() {
      await axios.get('api/foods')
        .then((response) => {
          this.desserts = (response.data);
        })
        .catch(error => {});
    },
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem(item) {
      //local array index
      this.editedIndex = this.desserts.indexOf(item)
      //database object with id
      this.editedItem = Object.assign({}, item)
      this.dialogDelete = true
    },

    async deleteItemConfirm() {
      await axios.delete('api/foods/' + this.editedItem.id)
        .then(response => {
          if (response.status === 200) {
            this.desserts.splice(this.editedIndex, 1)
            this.snackbar = true;
            this.snackcolor = 'success';
            this.snacktext = 'The Food was removed successfully.';
          } else {
            this.snackbar = true;
            this.snackcolor = 'error';
            this.snacktext = 'An error occurred.  The Food was not removed.';
          }
        })
      this.closeDelete()
    },

    close() {
      this.dialog = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    closeDelete() {
      this.dialogDelete = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    async save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem)
        await axios.put('api/foods/' + this.editedItem.id, this.editedItem).then(response => {
          if (response.status === 200) {
            this.desserts.splice(this.editedIndex, 1)
            this.snackbar = true;
            this.snackcolor = 'success';
            this.snacktext = 'The Food was added successfully.';
          } else {
            this.snackbar = true;
            this.snackcolor = 'error';
            this.snacktext = 'An error occurred.  The Food was not added.';
          }
        })
        this.desserts.push(this.editedItem)
      } else {
        console.log(this.editedItem)
        await axios.post('api/foods/', this.editedItem).then(response => {
          if (response.status === 200) {
            this.desserts.splice(this.editedIndex, 1)
            this.snackbar = true;
            this.snackcolor = 'success';
            this.snacktext = 'The Food was added successfully.';
          } else {
            this.snackbar = true;
            this.snackcolor = 'error';
            this.snacktext = 'An error occurred.  The Food was not added.';
          }
        })
        this.desserts.push(this.editedItem)
      }
      this.close()
    },
  },
}
</script>
