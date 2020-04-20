<template>
    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="blue"
                dark
                flat
              >
                <v-toolbar-title>Register form</v-toolbar-title>
                <v-spacer />
                
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="Name"
                    name="name"
                    type="text"
                    v-model="name"
                  />
                  
                  <v-text-field
                    label="Email"
                    name="email"
                    type="text"
                    v-model="email"
                  />

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    type="password"
                    v-model="password"
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn color="blue" @click="login">Register</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
</template>

<script>
  export default {
    name:'login',
    props: {
      source: String,
    },
    data() {
        return{
            username:'',
            email:'',
            password:'',
        }
    },
    methods:{
        login(){
            console.log(this.password)
            fetch(`/api/register`, {
                        method:'POST',
                        headers:
                        {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({'name':this.name, 'email':this.email, 'password':this.password})
                    })
                    .then(res=>res.json())
                    .then(res=>{
                        console.log(res);
                        if(res=='Registered succesfully')
                        {
                            this.$router.push({name:'login'})
                        }
                    })
                    .catch(err=>{console.log(err)
                    });
        }
    }
  }
</script>