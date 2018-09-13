<template lang="html">
    <div class="List ProfileActivities">
        <div class="List-header">
            <h4 class="List-headerText">
                <div class="SubTabs">
                    <button @click="current='follow'" :class="['SubTabs-item', {'is-active': current=='follow'}]">
                        {{user.is_self ? '我' : '他' }}关注的人
                    </button>
                    <button @click="current='followed'" :class="['SubTabs-item', {'is-active': current=='followed'}]">
                        关注{{user.is_self ? '我' : '他' }}的人
                    </button>
                    <button @click="current='userQuestion'" :class="['SubTabs-item', {'is-active': current=='userQuestion'}]">
                        {{user.is_self ? '我' : '他' }}关注的问题
                    </button>
                    <button @click="current='userTopic'" :class="['SubTabs-item', {'is-active': current=='userTopic'}]">
                        {{user.is_self ? '我' : '他' }}关注的话题
                    </button>
                </div>
            </h4>
        </div>
        <div v-if="data.length" v-for="item of data" :key="item.id" class="List-item">
            <div v-if="current=='follow'||current=='followed'" class="ContentItem">
                <div class="ContentItem-main">
                    <div class="ContentItem-image">
                        <span class="UserLink UserItem-avatar">
                            <a class="UserLink-link" target="_blank" :href="'/people/'+item.id">
                                <img class="Avatar Avatar--large UserLink-avatar" width="60" height="60" :src="item.avatar" :srcset="`${item.avatar} 2x`" :alt="item.name">
                            </a>
                        </span>
                    </div>
                    <div class="ContentItem-head">
                        <h2 class="ContentItem-title">
                            <div class="UserItem-title">
                                <span class="UserLink UserItem-name">
                                    {{item.name}}
                                </span>
                            </div>
                        </h2>
                        <div class="ContentItem-meta">
                            <div class="ContentItem-status">
                                <span class="ContentItem-statusItem">{{item.followings_count}} 关注者</span>
                            </div>
                        </div>
                    </div>
                    <div class="ContentItem-extra">
                        <button :disabled="item.is_self" v-if="!item.is_follow"  @click="toggleFollow(item)" class="Button Button--primary Button--blue">
                            <svg fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em" class="Icon Zi Zi--Plus"><path d="M13.491 10.488s-.012-5.387 0-5.998c-.037-1.987-3.035-1.987-2.997 0-.038 1.912 0 5.998 0 5.998H4.499c-1.999.01-1.999 3.009 0 3.009s5.995-.01 5.995-.01v5.999c0 2.019 3.006 2.019 2.997 0-.01-2.019 0-5.998 0-5.998s3.996.009 6.004.009c2.008 0 2.008-3-.01-3.009h-5.994z" fill-rule="evenodd"></path></svg>
                            关注
                        </button>
                        <button v-if="item.is_follow" @click="toggleFollow(item)" class="Button Button--primary Button--grey">
                            已关注
                        </button>
                    </div>
                </div>
            </div>
            <div v-if="current=='userQuestion'" class="ContentItem">
                <h2 class="ContentItem-title">
                    <div class="QuestionItem-title">
                        <a :href="'/question/'+item.id" target="_blank">
                            {{item.title}}
                        </a>
                    </div>
                </h2>
                <div class="ContentItem-status">
                    <span class="ContentItem-statusItem">{{item.created_at}}</span>
                    <span class="ContentItem-statusItem">{{item.answers_count}} 个回答</span>
                    <span class="ContentItem-statusItem">{{item.followers_count}} 个关注</span>
                </div>
            </div>
            <div v-if="current=='userTopic'" class="ContentItem">
                <div class="ContentItem-main">
                    <div class="ContentItem-image">
                        <img class="Avatar Avatar--large" width="60" height="60" :src="item.topic_pic" :srcset="`${item.topic_pic} 2x`">
                    </div>
                    <div class="ContentItem-head">
                        <h2 class="ContentItem-title">
                            <a class="TopicLink" :href="'/topic/'+item.id" target="_blank">
                                {{item.name}}
                            </a>
                        </h2>
                        <div class="ContentItem-meta">
                            <div class="ContentItem-status">
                                <span class="ContentItem-statusItem TopicItem-statusLink">{{item.questions_count}} 个回答</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="!data.length" class="EmptyState">
            <div class="EmptyState-inner">
                <template v-if="current=='follow' || current=='followed'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="120" viewBox="0 0 150 120" class="EmptyState-image"><title></title><g><g fill="none" fill-rule="evenodd"><path fill="#EBEEF5" fill-rule="nonzero" d="M44 31.005v55.99A3.003 3.003 0 0 0 47.003 90h53.994A3.005 3.005 0 0 0 104 86.995v-55.99A3.003 3.003 0 0 0 100.997 28H47.003A3.005 3.005 0 0 0 44 31.005zm-3 0A6.005 6.005 0 0 1 47.003 25h53.994A6.003 6.003 0 0 1 107 31.005v55.99A6.005 6.005 0 0 1 100.997 93H47.003A6.003 6.003 0 0 1 41 86.995v-55.99z"></path><path fill="#F7F8FA" d="M59 50a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm12-9.5c0-.828.68-1.5 1.496-1.5h9.008c.826 0 1.496.666 1.496 1.5 0 .828-.68 1.5-1.496 1.5h-9.008A1.495 1.495 0 0 1 71 40.5zm0 7c0-.828.667-1.5 1.5-1.5h21c.828 0 1.5.666 1.5 1.5 0 .828-.667 1.5-1.5 1.5h-21c-.828 0-1.5-.666-1.5-1.5zM59 73a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm12-9.5c0-.828.68-1.5 1.496-1.5h9.008c.826 0 1.496.666 1.496 1.5 0 .828-.68 1.5-1.496 1.5h-9.008A1.495 1.495 0 0 1 71 63.5zm0 7c0-.828.667-1.5 1.5-1.5h21c.828 0 1.5.666 1.5 1.5 0 .828-.667 1.5-1.5 1.5h-21c-.828 0-1.5-.666-1.5-1.5z"></path></g></g></svg>
                    还没有关注的用户
                </template>
                <template v-if="current=='userQuestion'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="120" viewBox="0 0 150 120" class="EmptyState-image"><title></title><g><g fill="none" fill-rule="evenodd"><path fill="#EBEEF5" fill-rule="nonzero" d="M109.545 78h5.463A2.995 2.995 0 0 0 118 75.01V34.99c0-1.648-1.34-2.99-2.992-2.99H62.992A2.995 2.995 0 0 0 60 34.99v2.027h-3V34.99c0-3.308 2.69-5.99 5.992-5.99h52.016A5.993 5.993 0 0 1 121 34.99v40.02c0 3.308-2.69 5.99-5.992 5.99h-2.744l-.558 5.65c-.217 2.197-1.783 2.842-3.49 1.45l-8.7-7.1h-18.69v-3h19.76l8.29 6.767.67-6.767zM37.33 91.9c-1.942 1.057-3.23.15-2.878-2.027l1.237-7.64A25.886 25.886 0 0 1 30 66c0-14.36 11.637-26 26-26 14.36 0 26 11.637 26 26 0 14.36-11.637 26-26 26-4.627 0-8.973-1.21-12.737-3.327L37.33 91.9zm5.958-6.656l1.447.814A22.878 22.878 0 0 0 56 89c12.705 0 23-10.296 23-23 0-12.705-10.296-23-23-23-12.705 0-23 10.296-23 23a22.894 22.894 0 0 0 5.03 14.36l.833 1.04-1.11 6.855 5.535-3.01zm13.108-31.452c2.304 0 4.176.612 5.616 1.908 1.44 1.26 2.16 2.988 2.16 5.148 0 1.764-.468 3.24-1.368 4.392-.324.396-1.332 1.332-3.024 2.808-.684.576-1.188 1.224-1.512 1.872-.396.72-.576 1.512-.576 2.376v.612H53.84v-.612c0-1.332.216-2.484.72-3.42.468-1.008 1.836-2.484 4.068-4.464l.612-.684c.648-.828 1.008-1.692 1.008-2.628 0-1.26-.36-2.232-1.044-2.952-.72-.72-1.764-1.08-3.06-1.08-1.62 0-2.808.504-3.528 1.548-.648.864-.972 2.088-.972 3.672h-3.78c0-2.628.756-4.68 2.268-6.192 1.512-1.548 3.6-2.304 6.264-2.304zm-.648 21.06c.756 0 1.404.216 1.908.72.504.468.756 1.08.756 1.836s-.288 1.368-.792 1.872a2.703 2.703 0 0 1-1.872.72c-.72 0-1.368-.252-1.872-.756s-.756-1.116-.756-1.836c0-.756.252-1.368.756-1.836.504-.504 1.152-.72 1.872-.72z"></path><path fill="#F7F8FA" d="M83.23 56h24.275c.818 0 1.495-.672 1.495-1.5 0-.834-.67-1.5-1.495-1.5H81.93a28.845 28.845 0 0 1 3.002 11h12.56a1.5 1.5 0 1 1 0 3h-12.51a29.422 29.422 0 0 0-.05-3zM72.285 42h35.22c.826 0 1.495.666 1.495 1.5 0 .828-.677 1.5-1.495 1.5H76a28.945 28.945 0 0 0-3.715-3z"></path></g></g></svg>
                    还没有关注的问题
                </template>
                <template v-if="current=='userTopic'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="120" viewBox="0 0 150 120" class="EmptyState-image"><title></title><g><g fill="none" fill-rule="evenodd"><path fill="#EBEEF5" fill-rule="nonzero" d="M44 31.005v55.99A3.003 3.003 0 0 0 47.003 90h53.994A3.005 3.005 0 0 0 104 86.995v-55.99A3.003 3.003 0 0 0 100.997 28H47.003A3.005 3.005 0 0 0 44 31.005zm-3 0A6.005 6.005 0 0 1 47.003 25h53.994A6.003 6.003 0 0 1 107 31.005v55.99A6.005 6.005 0 0 1 100.997 93H47.003A6.003 6.003 0 0 1 41 86.995v-55.99z"></path><path fill="#F7F8FA" d="M59 50a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm12-9.5c0-.828.68-1.5 1.496-1.5h9.008c.826 0 1.496.666 1.496 1.5 0 .828-.68 1.5-1.496 1.5h-9.008A1.495 1.495 0 0 1 71 40.5zm0 7c0-.828.667-1.5 1.5-1.5h21c.828 0 1.5.666 1.5 1.5 0 .828-.667 1.5-1.5 1.5h-21c-.828 0-1.5-.666-1.5-1.5zM59 73a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm12-9.5c0-.828.68-1.5 1.496-1.5h9.008c.826 0 1.496.666 1.496 1.5 0 .828-.68 1.5-1.496 1.5h-9.008A1.495 1.495 0 0 1 71 63.5zm0 7c0-.828.667-1.5 1.5-1.5h21c.828 0 1.5.666 1.5 1.5 0 .828-.667 1.5-1.5 1.5h-21c-.828 0-1.5-.666-1.5-1.5z"></path></g></g></svg>
                    还没有关注的话题
                </template>
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
            data: [],
            current: 'follow'
        }
    },
    methods: {
        toggleTab() {
            axios.post(`/getFollow/${this.current}/${this.$parent.user_id}`).then((response) => {
                this.data = response.data;
            });
        },
        toggleFollow (item) {
            axios.post('/follow/user', {id: item.id}).then((response)=>{
                if(response.data.attached.length){
                    item.followings_count = item.followings_count + 1;
                } else {
                    item.followings_count = item.followings_count - 1;
                }
                item.is_follow = !item.is_follow;
            });
        }
    },
    watch: {
        current () {
            this.toggleTab();
        }
    },
    mounted () {
        this.toggleTab();
    }
}
</script>

<style lang="css">
</style>
