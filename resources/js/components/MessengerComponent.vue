<template>
    <b-container fluid style="height: calc(100vh - 56px);">
        <b-row no-gutters class="h-100">
            <b-col cols="4">
                <!-- //$event captura la data que viene del componente -->
                <contact-list-component 
                    @conversationSelected="changeActiveConversation($event)">
                    
                </contact-list-component>                  
            </b-col>
            <b-col cols="8">
                <active-conversation-component
                    v-if="selectedConversation"
                    :contact-id="selectedConversation.contact_id"
                    :contact-name="selectedConversation.contact_name">
                    
                </active-conversation-component>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        data () {
            return {
                //selectedConversation: null
                selectedConversation: []
            };
        },
        mounted() {
            console.log('Messenger Component mounted.')
        },
        methods: {
            changeActiveConversation(conversation) {
                console.log('Nueva conversacion seleccionada', conversation);
                this.selectedConversation = conversation;
            }
        }
    }
</script>
