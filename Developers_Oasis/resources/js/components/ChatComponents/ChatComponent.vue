<template>
    <div>
        <h2>Real-time Chat</h2>
        <div>
            <ul>
                <li v-for="(message, index) in messages" :key="index">
                    <strong>{{ message.user.name }}</strong>: {{ message.message }}
                </li>
            </ul>
        </div>
        <div>
            <input type="text" v-model="newMessage" placeholder="Type your message...">
            <button class="btn btn-primary" @click="sendMessage">Send</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            messages: [],
            newMessage: '',
        };
    },
    mounted() {
        window.Echo.private('chat')
            .listen('.message.sent', (data) => {
                this.messages.push(data.message);
            });
    },
    methods: {
        sendMessage() {
            if (this.newMessage) {
                axios.post('/api/send-message', { message: this.newMessage })
                    .then(response => {
                        this.newMessage = '';
                    });
            }
        },
    },
};
</script>
