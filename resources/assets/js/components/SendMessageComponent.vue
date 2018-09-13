<template lang="html">
    <modal ref="messageModal">
        <form @submit.prevent="send">
            <h3 slot="header" class="Modal-title">发送私信</h3>
            <div class="Messages-newDialog">
                <div class="Messages-receiver">
                    <span class="Messages-receiverInfo">{{user.name}}</span>
                </div>
                <div class="Messages-sendContent Input-wrapper Input-wrapper--spread Input-wrapper--multiline">
                    <textarea v-model="content" rows="5" class="Input" placeholder="私信内容"></textarea>
                </div>
                <div class="ModalButtonGroup ModalButtonGroup--vertical">
                    <button class="Button Messages-sendButton Button--primary Button--blue">发送</button>
                </div>
            </div>
        </form>
    </modal>
</template>

<script>
export default {
    data () {
        return {
            user: {},
            content: ""
        };
    },
    methods: {
        send () {
            if(this.content){
                axios.post('/message', {to_user_id: this.user.id, content: this.content}).then((response) => {
                    this.content = "";
                    this.$refs.messageModal.$emit('closeModal');
                    $.notification({
                        color: 'green',
                        content: '发送成功 !'
                    });
                });
            }
        }
    },
    mounted () {
        this.$on('showModal', (user)=>{
            this.user = user;
            this.$refs.messageModal.$emit('showModal');
        });
    }
}
</script>

<style lang="css">
</style>
