<template>
    <div>
        <button class="btn btn-primary" @click="followUser">
            Submit
        </button>
    </div>
</template>

<script>
    export default {

        props: ['userId','currentUserId'],
        mounted() {
            console.log('Component mounted.')
        },

        methods: {

            followUser(){
                alert('current user:' + this.currentUserId + ' follows user:' + this.userId);
                axios.post('/soen341/public/follow/' + this.userId)
                .then( response => {
                    alert(response.data);
                    location.reload();

                });
            }

        }
    }
</script>
