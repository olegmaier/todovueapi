<template>
<div>
    <h2>Tasks</h2>
    <v-form>
        <v-text-field label="Task" v-model="taskform.title" hide-details="auto"></v-text-field>
         <v-textarea
        v-model="taskform.description"
        auto-grow
        filled
        label="Description"
        rows="3"
      ></v-textarea>

        <v-btn
        color="success"
        class="mr-4 mt-4"
        @click="addOrUpdateTask">
      Save
      </v-btn>
    </v-form>
<v-divider class="mb-4 mt-4"></v-divider>
    <v-pagination
    v-model="pagination.current"
    :length="pagination.total"
    @input="fetchTasks"
    ></v-pagination>

    <v-card
    class="mx-auto"
    max-width="500"
     v-for="task in tasks" v-bind:key="task.id">

    <v-checkbox 
    :class="task.task_done && 'done' || ''"
    class="ml-4 mt-4"
    v-model="task.task_done"
    :color="task.task_done && 'grey' || 'primary'"
    @change="updateTaskStatus(task)">
        <template v-slot:label>
            <div
            :class="task.task_done && 'grey--text' || 'primary--text'"
            class="ml-4"
            v-text="task.title"
            ></div>
        </template>
    </v-checkbox>


    <v-card-text :class="task.task_done && 'done' || ''">
        {{task.description}}
    </v-card-text>
        <button @click="editTask(task)">Edit</button>
        <button @click="deleteTask(task.id)">Delete</button>
  </v-card>
</div>
    
</template>


<script>
    export default {
        name: 'tasks',
        data(){
            return{
                tasks:[],
                taskform:{
                    title:'',
                    description:'',
                    id:'',
                    user_id:1,
                    task_done:false,
                },
                task:{
                    id:'',
                    title:'',
                    description:'',
                    user_id:1,
                    done:false,
                },
                task_id:'',
                pagination: {},
                edit:false,
                pagination: {
                    current: 1,
                    total: 0
                }
            }
        },

        created()
        {
            this.fetchTasks();
        },
        methods:{
            fetchTasks(page_url){
                fetch('/api/tasks?page=' + this.pagination.current)
                    .then(res=>res.json())
                    .then(res=>{
                        this.tasks=res.data;
                        this.pagination.current = res.meta.current_page;
                        this.pagination.total = res.meta.last_page;
                    })
                    .catch(err=>console.log(err));
            },
            deleteTask(id)
            {
                if(confirm('Are you sure?'))
                {
                    fetch(`/api/tasks/${id}`, {
                    method:'DELETE'
                    })
                    .then(res=>{this.fetchTasks()})
                    .catch(err=>{console.log(err)});
                }
            },
            editTask(task)
            {
                this.taskform.description=task.description;
                this.taskform.title=task.title;
                this.taskform.id=task.id;
                this.edit=true;
            },
            addOrUpdateTask()
            {
                if(this.edit===false)
                {
                    //create
                    fetch(`/api/tasks`, {
                        method:'POST',
                        headers:
                        {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.taskform)
                    })
                    .then(res => {
                        this.fetchTasks();
                        this.taskform.description='';
                        this.taskform.title='';
                    })
                    .catch(err=>{console.log(err)
                    });
                }
                else
                {
                    //update
                    fetch(`/api/tasks/${this.taskform.id}`, {
                        method:'PUT',
                        headers:
                        {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.taskform)
                    })
                    .then(res => {
                        this.fetchTasks();
                        this.taskform.description='';
                        this.taskform.title='';
                        this.taskform.id='';
                        this.edit=false;
                        })
                        .catch(err=>{console.log(err)
                        })
                    
                }
            },

            updateTaskStatus(task)
            {
                console.log(task);
                fetch(`/api/tasks/${task.id}`, {
                    method:'PUT',
                    headers:
                    {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(task)
                })
                .then(res => {
                    this.fetchTasks();
                    })
                    .catch(err=>{console.log(err)
                    })
            }
        }  
    }
</script>

<style scoped>
.done {
  text-decoration: line-through;
}
</style>