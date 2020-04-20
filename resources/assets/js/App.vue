<template>
  <v-app>


    <v-app-bar
      app
      dark
    >
      <v-toolbar-title>ToDo List</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn v-if="loggedIn" :to="{name:'tasks'}">
        Tasks
      </v-btn>
      <v-btn v-if="loggedIn"  :to="{name:'users'}">
        Users
      </v-btn>
      <v-btn v-if="!loggedIn" :to="{name:'login'}">
        Login
      </v-btn>
      <v-btn v-if="!loggedIn"  :to="{name:'register'}">
        Register
      </v-btn>
      <v-btn v-if="loggedIn" :to="{name:'logout'}">
        Logout
      </v-btn>
    </v-app-bar>

    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col class="text-center">
           <router-view></router-view>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
    
    <v-footer
      app
    >
       
    </v-footer>
  </v-app>
</template>

<script>
  export default {
    computed:{
      loggedIn(){
        return localStorage.getItem('access_token');
      }
    },
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
      dialog: false,
    }),
  }
</script>