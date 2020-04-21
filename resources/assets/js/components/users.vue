<template>
<div>
    <h2>Users</h2>
    <v-form>
        <v-text-field label="User" v-model="userform.name" hide-details="auto"></v-text-field>
        <v-text-field label="Email" v-model="userform.email" hide-details="auto"></v-text-field>        
        <v-text-field type="password" label="Password" v-model="userform.password" hide-details="auto"></v-text-field>

        <v-btn
        color="success"
        class="mr-4 mt-4"
        @click="addOrUpdateUser">
      Save
      </v-btn>
    </v-form>
<v-divider class="mb-4 mt-4"></v-divider>
    <v-pagination
    v-model="pagination.current"
    :length="pagination.total"
    @input="fetchUsers"
    ></v-pagination>


  <v-simple-table>
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left">Name</th>
          <th class="text-left">Email</th>
          <th class="text-left">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" v-bind:key="user.id">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
                <v-btn @click="editUser(user)">Edit</v-btn>
                <v-btn @click="deleteUser(user.id)">Delete</v-btn>
            </td>
        </tr>
      </tbody>
    </template>
  </v-simple-table> 
</div>
    
</template>


<script>
    export default {
        name: 'users',
        data(){
            return{
                users:[],
                userform:{
                    name:'',
                    email:'',
                    password:'',
                },
                user:{
                    name:'',
                    email:'',
                    password:'',
                },
                edit:false,
                pagination: {
                    current: 1,
                    total: 0
                }
            }
        },

        created()
        {
            this.fetchUsers();
        },
        methods:{
            fetchUsers(page_url){
                fetch('/api/users?page=' + this.pagination.current)
                    .then(res=>res.json())
                    .then(res=>{
                        this.users=res.data;
                        this.pagination.current = res.meta.current_page;
                        this.pagination.total = res.meta.last_page;
                    })
                    .catch(err=>console.log(err));
            },
            deleteUser(id)
            {
                if(confirm('Are you sure?'))
                {
                    fetch(`/api/users/${id}`, {
                    method:'DELETE'
                    })
                    .then(res=>{this.fetchUsers()})
                    .catch(err=>{console.log(err)});
                }
            },
            editUser(user)
            {
                this.userform.name=user.name;
                this.userform.email=user.email;
                this.userform.id=user.id;
                this.edit=true;
            },
            addOrUpdateUser()
            {
                if(this.edit===false)
                {
                    //create
                    fetch(`/api/register`, {
                        method:'POST',
                        headers:
                        {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.userform)
                    })
                    .then(res => {
                        this.fetchUsers();
                        this.userform.name='';
                        this.userform.email='';
                        this.userform.password='';
                    })
                    .catch(err=>{console.log(err)
                    });
                }
                else
                {
                    //update
                    fetch(`/api/users/${this.userform.id}`, {
                        method:'PUT',
                        headers:
                        {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.userform)
                    })
                    .then(res => {
                        this.fetchUsers();
                        this.userform.name='';
                        this.userform.email='';
                        this.userform.password='';
                        this.edit=false;
                        })
                        .catch(err=>{console.log(err)
                        })
                    
                }
            },

        }  
    }
</script>
