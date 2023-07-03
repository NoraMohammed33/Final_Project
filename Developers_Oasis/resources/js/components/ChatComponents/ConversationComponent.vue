<template>
    <div class="conversation border rounded-4">
        <h1>{{contact ? contact.name : 'Select a Contact'}}</h1>
        <MessageFeed :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage"/>
    </div>
</template>

<script>
import MessageFeed from "@/components/ChatComponents/MessageFeed.vue";
import MessageComposer from "@/components/ChatComponents/MessageComposer.vue";
import axios from "axios";
export default {
    name: "ConversationComponent",
    components: {MessageComposer, MessageFeed},
    props:{
        contact:{
            type: Object,
            default: null
        },
        messages:{
            type: Array,
            default: []
        }
    },
    methods:{
        sendMessage(text){
            if(!this.contact){
                return;
            }
            axios.post('/conversation/send',{
                contact_id: this.contact.id,
                content: text
            }).then((response)=>{
                this.$emit('new', response.data)
            })
        }
    }

}
</script>

<style lang="scss" scoped>
.conversation{
    flex:5;
    display:flex;
    flex-direction: column;
    justify-content: space-between;
    h1{
        font-size:20px;
        padding:10px;
        margin:10px;
        border-bottom:1px dashed lightgray;
    }
}
</style>
