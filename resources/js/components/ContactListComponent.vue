<template>
    <b-list-group>
        <contact-component 
            v-for="conversation in conversations"
            :key="conversation.id"
            :conversation="conversation"
            :selected="conversation.id === selectedConversationId"
            @click.native="selectConversation(conversation)">
        </contact-component>
    </b-list-group>          
</template>

<script>
    export default {
        props: {
            conversations: Array
        },
        data () {
            return {
                selectedConversationId: null
            };
        },
        mounted() {
            console.log('Contact List Component mounted.')
        },
        methods: {
            selectConversation(conversation) {
                //console.log('selectConversation fired');
                //console.log(conversation);
                //Emite este método para que lo detecte el componente padre
                this.selectedConversationId = conversation.id;
                this.$emit('conversationSelected', conversation);
            }
        }
    }
</script>
