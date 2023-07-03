<template>
    <div class="chatApp d-flex m-3 justify-content-between">
        <ConversationComponent :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        <ContactsListComponent class="mx-2" :contacts="contacts" @selected="startConversationWith"/>
    </div>
</template>

<script>
import axios from "axios";
import ConversationComponent from "@/components/ChatComponents/ConversationComponent.vue";
import ContactsListComponent from "@/components/ChatComponents/ContactsListComponent.vue";
export default {
    components: {ContactsListComponent, ConversationComponent},
    data() {
        return {
           user_id:'',
           selectedContact: null,
           messages: [],
           contacts: []
        };
    },
    mounted() {
        this.getAllContacts()
        Echo.private(`messages${1}`)
            .listen('MessageSent',(e)=>{
                this.handleIncoming(e.message.content);
            })

    },
    methods: {
        getAllContacts(){
            axios.get('/contacts')
                .then((response)=>{
                    console.log(response)
                    this.user_id = response.data.user.id
                    this.contacts = response.data.contacts
                })
        },
        startConversationWith(contact){
            axios.get(`/conversation/${contact.id}`)
                .then((response)=>{
                    this.messages = response.data;
                    this.selectedContact = contact;
                })
        },
        saveNewMessage(text){
            this.messages.push(text)
        },
        handleIncoming(message){
            if(this.selectedContact && message.sender_id === this.selectedContact.id) {
                this.saveNewMessage(message);
                return;
            }
            alert(message.content);
        }
    },
};
</script>

<style scoped>

</style>


