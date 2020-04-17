<template>
<div>
    <h2>Tasks</h2>
    <div v-for="task in tasks" v-bind:key="task.id">
        <h3>{{task.title}}</h3>
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
                    user_id:''
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
            fetchTasks(){
                fetch('api/tasks')
                    .then(res=>res.json())
                    .then(res=>{
                        this.tasks=res.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>