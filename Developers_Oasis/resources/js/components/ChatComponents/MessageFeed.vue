<template>
    <div class="feed bg-grey-lighten-2 p-2" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" class="w-100" :class="`message${message.recipient_id === contact.id ? ' sent' : ' recieved'}`" :key="message.id">
                <div class="text">
                    {{message.content}}
                </div>
            </li>
        </ul>

    </div>
</template>

<script>
export default {
    name: "MessageFeed",
    props:{
        contact:{
            type:Object,
            required: true
        },
        messages:{
            type:Array,
            required:true
        }
    },
    methods:{
        scrollToBottom(){
            setTimeout(()=>{
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            },50)
        }
    },
    watch:{
        contact(contact){
            this.scrollToBottom()
        },
        messages(messages){
            this.scrollToBottom()
        }
    }

}
</script>

<style lang="scss" scoped>
.feed::-webkit-scrollbar {
    display: none;
}
.feed{
    background:#f0f0f0;
    height:100%;
    max-height:420px;
    overflow:scroll;

    ul{
        list-style-type: none;
        padding:5px;
        li{
            &.message{
                margin:10px 0;
                width:150px;

                .text{
                    max-width:300px;
                    border-radius:5px;
                    padding:12px;
                    display:inline-block;
                }
                &.recieved{
                    text-align:right;

                    .text{
                        background:#b2b2b2;
                    }
                }
                &.sent{
                    text-align:left;

                    .text{
                        background:#81c4f9;
                    }
                }
            }
        }
    }
}
</style>
