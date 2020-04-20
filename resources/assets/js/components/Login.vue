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
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer />
                
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="Login"
                    name="login"
                    type="text"
                    v-model="username"
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
                <v-btn color="blue" @click="login">Login</v-btn>
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
            password:'',
            token:localStorage.getItem('access_token') || null,
        }
    },
    methods:{
        login(){
            console.log(this.password)
            fetch(`/api/login`, {
                        method:'POST',
                        headers:
                        {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({'username':this.username, 'password':this.password})
                    })
                    .then(res=>res.json())
                    .then(res=>{
                        //console.log(res);
                        if(res.access_token!=undefined)
                        {
                            localStorage.setItem('access_token', res.access_token);
                            this.$router.push({name:'tasks'})
                        }
                    })
                    .catch(err=>{console.log(err)
                    });
        }
    }
  }
</script>