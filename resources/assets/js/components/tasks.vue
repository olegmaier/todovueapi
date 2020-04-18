<template>
<div>
    <h2>Tasks</h2>
    <form action="" @submit.prevent="addOrUpdateTask()">
        <input type="text" placeholder="Title" v-model="task.title">
        <textarea placeholder="Description" v-model="task.description"></textarea>
        <button type="submit">Save</button>
    </form>
    <ul class="pagination">
        <li v-bind:class="[{disabled:!pagination.prev_page_url}]">
            <a href="#" @click="fetchTasks(pagination.prev_page_url)">Previous</a>
        </li>
        <li>
            Page {{pagination.current_page}} of {{pagination.last_page}}
        </li>
        <li v-bind:class="[{disabled:!pagination.next_page_url}]">
            <a href="#" @click="fetchTasks(pagination.next_page_url)">Next</a></li>
    </ul>
    <div v-for="task in tasks" v-bind:key="task.id">
        <h3>{{task.title}}</h3>
        <p>{{task.description}}</p>
        <button @click="editTask(task)">Edit</button>
        <button @click="deleteTask(task.id)">Delete</button>
    </div>
</div>
    
</template>


<script>
    export default{
        data(){
            return{
                tasks:[],
                task:{
                    id:'',
                    title:'',
                    description:'',
                    user_id:1
                },
                task_id:'',
                pagination: {},
                edit:false
            }
        },

        created()
        {
            this.fetchTasks();
        },
        methods:{
            fetchTasks(page_url){
                let vm=this;
                page_url=page_url||'/api/tasks';
                fetch(page_url)
                    .then(res=>res.json())
                    .then(res=>{
                        this.tasks=res.data;
                        vm.makePagination(res.meta, res.links);
                    })
                    .catch(err=>console.log(err));
            },
            makePagination(meta, links){
                let pagination={
                    current_page:meta.current_page,
                    last_page:meta.last_page,
                    next_page_url:links.next,
                    prev_page_url:links.prev
                }
                this.pagination=pagination;
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
                this.task.description=task.description;
                this.task.title=task.title;
                this.task.id=task.id;
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
                        body: JSON.stringify(this.task)
                    })
                    .then(res => {
                        this.fetchTasks();
                        this.task.description='';
                        this.task.title='';
                    })
                    .catch(err=>{console.log(err)
                    });
                }
                else
                {
                    //update
                    fetch(`/api/tasks/${this.task.id}`, {
                        method:'PUT',
                        headers:
                        {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.task)
                    })
                    .then(res => {
                        this.fetchTasks();
                        this.task.description='';
                        this.task.title='';
                        this.task.id='';
                        this.edit=false;
                        })
                        .catch(err=>{console.log(err)
                        })
                    
                }
            }
        }  
    }
</script>

<style scoped>

</style>