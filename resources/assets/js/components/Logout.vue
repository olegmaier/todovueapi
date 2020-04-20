<template>
  
</template>

<script>
export default {
    created(){
        var access_token=localStorage.getItem('access_token')
        if(access_token)
        {
        
            fetch(`/api/logout`, {
                    method:'POST',
                    headers:
                    {
                        'Content-Type': 'application/json',
                        'Authorization':'Bearer '+ access_token
                    }
                })
                .then(res=>res.json())
                .then(res=>{
                    localStorage.removeItem('access_token');
                    this.$router.push({name:'Home'})
                })
                .catch(err=>{console.log(err)
             });
        }
    }
}
</script>

<style>

</style>