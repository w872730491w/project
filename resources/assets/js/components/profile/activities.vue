<template lang="html">
    <div class="List ProfileActivities">
        <div class="List-header">
            <h4 class="List-headerText"><span>{{user.is_self ? '我的' : '他的' }}动态</span></h4>
            <div class="List-headerOptions"></div>
        </div>
        <div v-if="data.length" v-for="item of data" :key="item.id" class="List-item">
            <div class="List-itemMeta">
                <div class="ActivityItem-meta">
                    <span class="ActivityItem-metaTitle">
                        <template v-if="item.type=='App\\Notifications\\LikesNotification'">
                            {{item.data.like}}
                        </template>
                        <template v-if="item.type=='App\\Notifications\\UserFollowNotification'">
                            关注了你
                        </template>
                        <template v-if="item.type=='App\\Notifications\\AnswerNotification'">
                            回答了问题
                        </template>
                    </span>
                    <span>{{item.created_at}}</span>
                </div>
                <template v-if="item.type=='App\\Notifications\\LikesNotification'">
                    <div class="PushNotifications-item">
                        <a :href="'/people'+item.data.user_id">{{item.data.user_name}}</a>
                        {{item.data.like}}
                        <a :href="item.data.to_url">{{item.data.to_name}}</a>
                    </div>
                </template>
                <template v-if="item.type=='App\\Notifications\\UserFollowNotification'">
                    <div class="PushNotifications-item PushNotifications-followItem">
                        <div class="AuthorInfo">
                            <span class="UserLink AuthorInfo-avatarWrapper">
                                <img width="40" height="40" :src="item.data.user_avatar" :srcset="item.data.user_avatar+' 2x'" :alt="item.data.user_name" class="Avatar Avatar--medium AuthorInfo-avatar">
                            </span>
                            <div class="AuthorInfo-content">
                                <div class="AuthorInfo-head">
                                    <span class="UserLink AuthorInfo-name">{{item.data.user_name}}</span>
                                </div>
                                <div class="AuthorInfo-detail">
                                    <div class="AuthorInfo-badge">
                                        <div class="RichText ztext AuthorInfo-badgeText">{{item.data.user_introduction}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-if="item.type=='App\\Notifications\\AnswerNotification'">
                    <div class="PushNotifications-item">
                        <a :href="'/people'+item.data.user_id">{{item.data.user_name}}</a>
                        回答了你的问题
                        <a :href="item.data.question_id">{{item.data.question}}</a>
                    </div>
                </template>
            </div>
        </div>
        <div v-if="!data.length" class="EmptyState">
            <div class="EmptyState-inner">
                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="120" viewBox="0 0 150 120" class="EmptyState-image"><title></title><g><g fill="none" fill-rule="evenodd"><path fill="#EBEEF5" fill-rule="nonzero" d="M94 29v-2.002c0-.55.443-.998 1-.998h1c.553 0 1 .446 1 .998V29h2.002c.55 0 .998.443.998 1v1c0 .553-.446 1-.998 1H97v2.002c0 .55-.443.998-1 .998h-1c-.553 0-1-.446-1-.998V32h-2.002A.997.997 0 0 1 91 31v-1c0-.553.446-1 .998-1H94zm30.613 17.724l-21.82-4.638.207-3.023 22.237 4.727a6.004 6.004 0 0 1 4.62 7.122l-7.9 37.158a6.001 6.001 0 0 1-7.116 4.627l-15.31-3.254.63-2.934 15.31 3.25c1.62.34 3.218-.69 3.56-2.32l7.9-37.16a3.005 3.005 0 0 0-2.31-3.567zM48.596 85.727l.624 2.935-12.717 2.703a6.004 6.004 0 0 1-7.117-4.628L21.488 49.58a6.004 6.004 0 0 1 4.62-7.123L47 38.017l.133 3.038-20.402 4.337a3 3 0 0 0-2.3 3.564l7.9 37.157a3.005 3.005 0 0 0 3.56 2.317l12.71-2.703zM100 82c0 3.314-2.688 6-6.006 6H56.006A6.01 6.01 0 0 1 50 82V34c0-3.314 2.688-6 6.006-6h27.147v3H56.006A3.003 3.003 0 0 0 53 34v48c0 1.65 1.35 3 3.006 3h37.988A3.003 3.003 0 0 0 97 82V42.373h3V82zm-4.5-41C89.7 41 85 36.3 85 30.5S89.7 20 95.5 20 106 24.7 106 30.5 101.3 41 95.5 41zm0-3a7.5 7.5 0 1 0 0-15 7.5 7.5 0 0 0 0 15z"></path><path fill="#F7F8FA" d="M47 73.22l-6.484 1.378c-.82.174-1.333.97-1.16 1.78.173.816.97 1.327 1.784 1.154L47 76.287V73.22zm0-8.594l-4.58.974c-.8.17-1.324.968-1.152 1.778a1.494 1.494 0 0 0 1.775 1.156l3.957-.84v-3.068zm0-17.285a6.002 6.002 0 0 0-8 5.66 6.002 6.002 0 0 0 8 5.66V47.34zm56 29.88l6.178 1.318a1.5 1.5 0 1 0 .624-2.934L103 74.148v3.067zm0-8.58l4.275.91c.808.17 1.6-.34 1.775-1.157a1.507 1.507 0 0 0-1.15-1.78l-4.9-1.04v3.067zm0-8.97c.626.22 1.3.34 2 .34 3.314 0 6-2.685 6-6s-2.686-6-6-6c-.7 0-1.374.12-2 .34v11.32zM76 56a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm-8 7.5c0-.828.667-1.5 1.505-1.5h12.99a1.5 1.5 0 1 1 0 3h-12.99A1.5 1.5 0 0 1 68 63.5zm-5 8c0-.828.67-1.5 1.49-1.5h23.02c.822 0 1.49.666 1.49 1.5 0 .828-.67 1.5-1.49 1.5H64.49c-.822 0-1.49-.666-1.49-1.5z"></path></g></g></svg>
                还没有动态
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    data () {
        return {
            data: []
        }
    },
    mounted () {
        axios.post('/getNotification/'+this.$parent.user_id).then((response) => {
            this.data = response.data;
        });
    }
}
</script>

<style lang="css" scoped="true">
.PushNotifications-item {
    padding: 0;
    border: 0;
}
.PushNotifications-item::after {
    border: 0;
    height: 0;
    background: none;
}
</style>
