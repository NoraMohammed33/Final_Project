<template>
    <div class="composer">
        <textarea v-model="message" class="form-control" @keydown.enter="send" placeholder="Message...."></textarea>
    </div>
</template>

<script>
export default {
    name: "MessageComposer",
    data(){
        return{
            message:''
        }
    },
    methods:{
        send(e){
            e.preventDefault();
            if(this.message === ''){
                return;
            }
            this.$emit('send',this.message);
            this.message = '';

        }
    }
}
</script>

<style lang="scss" scoped>
    .composer textarea{
        width:96%;
        margin: 10px;
        resize:none;
        border-radius: 3px;
        border:1px solid lightgray;;
        padding:6px;
    }
</style>
