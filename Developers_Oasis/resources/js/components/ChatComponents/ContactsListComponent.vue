<template>
    <div class="contacts-list rounded-3 shadow-lg mt-3">
    <ul>
        <li v-for="(contact, index) in contacts" :key="contact.id" @click="selectContact(index, contact)" :class="{'selected' : index === selected}">
            <div class="contact p-2 border-5">
                <strong class=" font-weight-bold fs-5">{{contact.name}}</strong>
                <p class="email">{{contact.email}}</p>
            </div>
        </li>
    </ul>
    </div>
</template>

<script>
export default {
    name: "ContactsListComponent",
    props:{
        contacts:{
            type: Array,
            default: []
        }
    },
    data(){
        return{
            selected:0
        };
    },
    methods:{
        selectContact(index,contact){
            this.selected = index;
            this.$emit('selected',contact)
        }
    }
}
</script>

<style lang="scss" scoped>
.contacts-list::-webkit-scrollbar {
    display: none;
}
.contacts-list{
    flex:2;
    max-height:550px;
    overflow:scroll;
    border-left:1px solid #a6a6a6;

    ul{
        list-style-type:none;
        padding-left:0;

        li:hover{
            background: #81c477;
            color:white;
            transition: 0s;
        }
        li{
            display:flex;
            padding: 2px;
            border-bottom: 1px solid #aaaaaa;
            height:80px;
            position:relative;
            cursor: pointer;

            &.selected{
                background: #81c411;
                color:white
            }

            .contect{
                flex:3;
                font-size:10px;
                overflow:hidden;
                display:flex;
                flex-direction: column;
                justify-content: center;
                p{
                    margin:0;
                    &.name{
                    font-weight:bold;
                }
                }
            }
        }
    }
}
</style>
