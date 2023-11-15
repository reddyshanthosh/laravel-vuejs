<template>
  <v-data-table
    :headers="headers"
    :items="desserts"
    :items-per-page="5"
    class="elevation-1"
  ></v-data-table>
</template>
<script>
  export default {
    data () {
      return {
        headers: [
          {
            text: 'Dessert (100g serving)',
            align: 'start',
            sortable: false,
            value: 'name',
          },
          { text: 'Calories', value: 'calories' },
          { text: 'Fat (g)', value: 'fat' },
          { text: 'Carbs (g)', value: 'carbs' },
          { text: 'Protein (g)', value: 'protein' },
          { text: 'Iron (%)', value: 'iron' },
        ],
        desserts: [],
      }
    },
 created () {
                         this.initialize()
                 },
 methods:
           {
                   initialize()
                   {
                            this.fetchApp()
                   },
		   async fetchApp(){
                       await axios.get('api/foods')
                            .then((response) => {
                                this.desserts = (response.data);
                             })
                           .catch(error => {});
             		},
},
  }
</script>
